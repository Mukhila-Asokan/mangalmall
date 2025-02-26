(function( $ ) {
	'use strict';
	
	var canvas_width = 1200,
	canvas_height = 628;
	
	var Unsaved = false;
	var group_layer = false;
	window.DEBUG = false;
	var image_data = '', bad_word_checker = false, color_name_checker = [];
	var history = {state: [], lock: true, mods: 0};

	var properties_to_save = Array("width", "height", "orig_src", "clip_left", "clip_top", "clip_width", "clip_height", "is_frame", "id");

	var ajaxurl = $('#base_url').val();
	var property_object = $('.ed_need_object');
	var element_text = $('.pg_element_text');
	var element_ai_text = $('.pg_element_ai_text');
	var element_shape = $('.pg_element_shape');
	var element_background = $('.pg_element_background');
	var element_image = $('.ed_element_image');
	var element_overlay = $('.pg_element_overlay');  

	var canvas = new fabric.Canvas("pg_canvas", {
		preserveObjectStacking: true,
		rotationCursor: 'url("../assets/images/rotcur.png") 10 10, crosshair'
	});
	
	// Make the rectangle draggable
    function setContainerHeight() {
        var screenWidth = $(window).width();

        // Set height to zero if the screen width is below a certain threshold (e.g., 600px)
        if (screenWidth < 600) {
          $('.canvas-container').css('height', '0');

        } else {
          // Set back to auto if not on a mobile screen
          $('.canvas-container').css('height', 'auto');
        }
    }
	$(window).on('resize', setContainerHeight);
	$(window).on('load', setContainerHeight);
	$(window).on('scroll', setContainerHeight);
	/**
	 * Add Grid Lines
	 */
	var layers = [];
	function addGrid() {
		// Add horizontal lines
		for (var i = 0; i < canvas.height; i += 20) {
			var line = new fabric.Line([0, i, canvas.width, i], {
				stroke: '#ebebeb',
				selectable: false
			});
			canvas.add(line);
		}
        // Add vertical lines
		for (var i = 0; i < canvas.width; i += 20) {
			var line = new fabric.Line([i, 0, i, canvas.height], {
				stroke: '#ebebeb',
				selectable: false
			});
			canvas.add(line);
		}
		canvas.renderAll();
	}
    function removeGrid() {
		// Remove all grid lines from the canvas
		canvas.getObjects('line').forEach(function (line) {
			canvas.remove(line);
		});
		canvas.renderAll();
	} 
	function createTimelineLayer() {
		var layer = new fabric.Rect({
			left: 0,
			top: 0,
			width: canvas.width,
			height: canvas.height,
			fill: 'transparent',
			selectable: false,
			hasBorders: false,
			hasControls: false,
		});

		layers.push(layer);
		canvas.add(layer);
		canvas.setActiveObject(layer); // Set the new layer as the active object
		canvas.renderAll();
	}
	
	$("#pg_grid_system").on('change',function() {
		if ($(this).is(":checked")) {
          addGrid();
		  createTimelineLayer();
		  console.log('checked!');
        } else {
		  removeGrid()
          console.log('unchecked!');
        }
	});
	canvas.setWidth(canvas_width).setHeight(canvas_height);
	set_canvas_size(canvas_width, canvas_height);
    // Initial canvas dimensions
	var screenWidth = $(window).width();
	if (screenWidth < 600) {
		var canvas_corners_size = 40;
		var crop_img_corners_size = 40;
		if (Modernizr.touch) {
			canvas_corners_size = 40;
			crop_img_corners_size = 40;
		}
	}else{
       
		var canvas_corners_size = 12;
		var crop_img_corners_size = 16;
		if (Modernizr.touch) {
			canvas_corners_size = 18;
			crop_img_corners_size = 20;
		}

	}
	fabric.Object.prototype.transparentCorners = false;
    fabric.Object.prototype.cornerSize = canvas_corners_size;
    fabric.Object.prototype.borderColor = "#feae19";
    fabric.Object.prototype.cornerColor = "#feae19";
	fabric.Object.prototype.resizeToScale = function() {
        switch (this.type) {
            case "circle":
                this.radius *= this.scaleX;
                this.scaleX = 1;
                this.scaleY = 1;
                break;
            case "ellipse":
                this.rx *= this.scaleX;
                this.ry *= this.scaleY;
                this.width = this.rx * 2;
                this.height = this.ry * 2;
                this.scaleX = 1;
                this.scaleY = 1;
                break;
            case "polygon":
            case "polyline":
                var f = this.get("points");
                for (var d = 0; d < f.length; d++) {
                    var g = f[d];
                    g.x *= this.scaleX;
                    g.y *= this.scaleY
                }
                this.scaleX = 1;
                this.scaleY = 1;
                this.width = this.getBoundingBox().width;
                this.height = this.getBoundingBox().height;
                break;
            case "triangle":
            case "line":
            case "rect":
                this.width *= this.scaleX;
                this.height *= this.scaleY;
                this.scaleX = 1;
                this.scaleY = 1;
            default:
                break
        }
    };
    fabric.Object.prototype.getBoundingBox = function() {
        var d = null;
        var k = null;
        var j = null;
        var h = null;
        switch (this.type) {
            case "polygon":
            case "polyline":
                var g = this.get("points");
                for (var f = 0; f < g.length; f++) {
                    if (typeof(d) == undefined) {
                        d = g[f].x
                    } else {
                        if (g[f].x < d) {
                            d = g[f].x
                        }
                    }
                    if (typeof(k) == undefined) {
                        k = g[f].y
                    } else {
                        if (g[f].y < k) {
                            k = g[f].y
                        }
                    }
                    if (typeof(j) == undefined) {
                        j = g[f].x
                    } else {
                        if (g[f].x > j) {
                            j = g[f].x
                        }
                    }
                    if (typeof(h) == undefined) {
                        h = g[f].y
                    } else {
                        if (g[f].y > h) {
                            h = g[f].y
                        }
                    }
                }
                break;
            default:
                d = this.left;
                k = this.top;
                j = this.left + this.width;
                h = this.top + this.height
        }
        return {
            topLeft: new fabric.Point(d, k),
            bottomRight: new fabric.Point(j, h),
            width: j - d,
            height: h - k
        }
    };
	canvas.on("mouse:down", function(d) {
        DEBUG && console.log(d);
        if (d.target) {
			//console.log(d);
			ed_hide_svg_text();
            switch (d.target.type) {
                case "text":
                case "i-text":
                    show_text_panel(d.target);
                    break;
                case "image":
                    show_img_edit_panel(d.target);
                    break;
                case "group":
                case "circle":
                case "rect":
					
					show_shape_edit_panel(d.target,true);
					break 
                case "line":
                case "triangle":
                case "path-group":
                    show_shape_edit_panel(d.target);
                    break
            }
        } else {
            show_background_edit();
			group_layer = false;
        }
		if(group_layer){
			property_object.find('.pg-property-widget').hide();
			element_background.hide();
			ed_remove_colorpicker();
			element_text.hide();
			element_ai_text.hide();
			element_overlay.hide();
			element_shape.hide();
			property_object.show();
			property_object.find('.pg-property-widget.edp_group_layer_option').show();
			property_object.find('.pg-property-widget.edp_layer_option').show();
			property_object.find('.pg-property-widget.edp_pos').show();
		} 
        canvas.renderAll();
	});
	canvas.on("object:rotating", function(d) {
        var f = canvas.getActiveObject() ? canvas.getActiveObject().angle : canvas.getActiveGroup().angle;
        jQuery("#ed_object_rotation_angle").val(parseInt(f));
    });
    canvas.on("object:moving", function(d) {
        set_object_pos();
		refreshLayer();
    });
	canvas.on("object:added", function(f) {
        if (!f.target.id) {
            if (!Date.now) {
                Date.now = function() {
                    return new Date().getTime()
                }
            }
            var d = Math.floor(Date.now());
            f.target.id = d
        }
        canvas.renderAll();
        DEBUG && console.log("added");
        save_history(1);
		//ad_buddy();
        //load_fonts(f.target)
		refreshLayer();
    });
	canvas.on("object:removed", function(d) {
        DEBUG && console.log("removed");
        //save_history();
		refreshLayer();
    });
	 canvas.on("object:modified", function(d) {
        DEBUG && console.log("modified");
        save_history(1);
		//ad_buddy();
		refreshLayer();
    });
	/* crop image canvas */
	var crop_img_canvas = new fabric.Canvas("crop_img");
    crop_img_canvas.setWidth(230);
    crop_img_canvas.setHeight(150);
    crop_img_canvas.calcOffset();
    crop_img_canvas.on("mouse:down", function(d) {
        crop_img_canvas.setActiveObject(crop_img_canvas.item(1))
    });
    crop_img_canvas.on("object:modified", function(j) {
		refreshLayer();
        if (!canvas.getActiveObject()) {
            return
        }
        if (j.target.oCoords.mr.x > crop_img_canvas.getWidth()) {
            j.target.left = crop_img_canvas.getWidth() - j.target.getWidth()
        }
        if (j.target.oCoords.bl.y > crop_img_canvas.getHeight()) {
            j.target.top = crop_img_canvas.getHeight() - j.target.getHeight()
        }
        if (j.target.left < 0) {
            j.target.left = 0
        }
        if (j.target.top < 0) {
            j.target.top = 0
        }
        if (j.target.getWidth() > crop_img_canvas.getWidth()) {
            j.target.scaleX = 1;
            j.target.setWidth(crop_img_canvas.getWidth())
        }
        if (j.target.getHeight() > crop_img_canvas.getHeight()) {
            j.target.scaleY = 1;
            j.target.setHeight(crop_img_canvas.getHeight())
        }
        j.target.setCoords();
        var h = crop_img_canvas.getActiveObject().left / crop_img_canvas.item(0).scaleX;
        var g = crop_img_canvas.getActiveObject().top / crop_img_canvas.item(0).scaleY;
        var f = crop_img_canvas.getActiveObject().getWidth() / crop_img_canvas.item(0).scaleX;
        var d = crop_img_canvas.getActiveObject().getHeight() / crop_img_canvas.item(0).scaleY;
		if(canvas.getActiveObject().orig_src){
			var r_src = canvas.getActiveObject().orig_src;
		}else{
			var r_src = canvas.getActiveObject().src;
		}
		
		var r_pos = r_src.indexOf(ajaxurl);
		if(r_pos > -1){
			fabric.Image.fromURL(r_src, function(m) {
				var l = m;
				l.orig_src = r_src;
				l.left = 0;
				l.top = 0;
				var k = l.toDataURL({
					format: "png",
					quality: 1,
					left: h,
					top: g,
					width: f,
					height: d
				});
				fabric.Image.fromURL(k, function(n) {
					//s_history = false;
					n.left = canvas.getActiveObject().left;
					n.top = canvas.getActiveObject().top;
					n.width = canvas.getActiveObject().getWidth();
					n.height = canvas.getActiveObject().getHeight();
					n.orig_src = r_src;
					n.angle = canvas.getActiveObject().angle;
					n.opacity = canvas.getActiveObject().opacity;
					n.clip_left = h;
					n.clip_top = g;
					n.clip_width = f;
					n.clip_height = d;
					var strfind = String(canvas.getActiveObject().clipTo);
					if (strfind.indexOf('ctx.arc') > 0) {
						n.clipTo = function (ctx) {var radius = this.width < this.height ? (this.width / 2) : (this.height / 2);ctx.arc(0, 0, radius, 0, Math.PI * 2, true);};
					}else if(strfind.indexOf('ctx.rect') > 0){
						n.clipTo = function (ctx) {var w = this.width < this.height ? this.width : this.height;ctx.rect(-w/2, -w/2, w, w);};
					}
					canvas.insertAt(n, canvas.getObjects().indexOf(canvas.getActiveObject()));
					canvas.remove(canvas.getActiveObject());
					canvas.setActiveObject(n);
					//s_history = true;
					save_history(1);
					//ad_buddy();
				});
				canvas.renderAll()
			});
		}else{
			var crossOriginImageObj = new Image();
			crossOriginImageObj.crossOrigin = "Anonymous";
			crossOriginImageObj.src = r_src;
			crossOriginImageObj.onerror = function() { console.log("cross-origin image load error"); }
			crossOriginImageObj.onload = function() {
				var b = new fabric.Image( crossOriginImageObj, {});
				var k = b.toDataURL({
					format: "png",
					quality: 1,
					left: h,
					top: g,
					width: f,
					height: d
				});
				fabric.Image.fromURL(k, function(n) {
					//s_history = false;
					n.left = canvas.getActiveObject().left;
					n.top = canvas.getActiveObject().top;
					n.width = canvas.getActiveObject().getWidth();
					n.height = canvas.getActiveObject().getHeight();
					n.orig_src = r_src;
					n.crossOrigin = "Anonymous";
					n.angle = canvas.getActiveObject().angle;
					n.opacity = canvas.getActiveObject().opacity;
					n.clip_left = h;
					n.clip_top = g;
					n.clip_width = f;
					n.clip_height = d;
					var strfind = String(canvas.getActiveObject().clipTo);
					if (strfind.indexOf('ctx.arc') > 0) {
						n.clipTo = function (ctx) {var radius = this.width < this.height ? (this.width / 2) : (this.height / 2);ctx.arc(0, 0, radius, 0, Math.PI * 2, true);};
					}else if(strfind.indexOf('ctx.rect') > 0){
						n.clipTo = function (ctx) {var w = this.width < this.height ? this.width : this.height;ctx.rect(-w/2, -w/2, w, w);};
					}
					canvas.insertAt(n, canvas.getObjects().indexOf(canvas.getActiveObject()));
					canvas.remove(canvas.getActiveObject());
					canvas.setActiveObject(n);
					//s_history = true;
					save_history(1);
					//ad_buddy();
				});
				canvas.renderAll();
			}
		}		
    });
	/* crop image canvas */
	/* crop bg canvas */
	var crop_bg_canvas = new fabric.Canvas("crop_bg");
    crop_bg_canvas.setWidth(230);
    crop_bg_canvas.setHeight(150);
    crop_bg_canvas.calcOffset();
    crop_bg_canvas.on("mouse:down", function(d) {
        crop_bg_canvas.setActiveObject(crop_bg_canvas.item(1))
    });
    crop_bg_canvas.on("object:modified", function(k) {
        if (k.target.oCoords.mr.x > crop_bg_canvas.getWidth()) {
            k.target.left = crop_bg_canvas.getWidth() - k.target.getWidth()
        }
        if (k.target.oCoords.bl.y > crop_bg_canvas.getHeight()) {
            k.target.top = crop_bg_canvas.getHeight() - k.target.getHeight()
        }
        if (k.target.left < 0) {
            k.target.left = 0
        }
        if (k.target.top < 0) {
            k.target.top = 0
        }
        if (k.target.getWidth() > crop_bg_canvas.getWidth()) {
            k.target.scaleX = 1;
            k.target.setWidth(crop_bg_canvas.getWidth())
        }
        if (k.target.getHeight() > crop_bg_canvas.getHeight()) {
            k.target.scaleY = 1;
            k.target.setHeight(crop_bg_canvas.getHeight())
        }
        k.target.setCoords();
        var j = crop_bg_canvas.getActiveObject().left / crop_bg_canvas.item(0).scaleX;
        var h = crop_bg_canvas.getActiveObject().top / crop_bg_canvas.item(0).scaleY;
        var f = crop_bg_canvas.getActiveObject().getWidth() / crop_bg_canvas.item(0).scaleX;
        var d = crop_bg_canvas.getActiveObject().getHeight() / crop_bg_canvas.item(0).scaleY;
        var g = canvas.getWidth() / f;
        canvas.backgroundImage.scale(g);
        canvas.backgroundImage.left = -j * g;
        canvas.backgroundImage.top = -h * g;
        canvas.renderAll()
    });
	/* crop bg canvas */
	/* align with arrow */
	const STEP = 5;

	var Direction = {
	  LEFT: 0,
	  UP: 1,
	  RIGHT: 2,
	  DOWN: 3
	};
	
	function moveSelected(direction){
		var activeObject = canvas.getActiveObject();
		var activeGroup = canvas.getActiveGroup();

		if (activeObject) {
			switch (direction) {
			  case Direction.LEFT:
				activeObject.setLeft(activeObject.getLeft() - STEP);
				break;
			  case Direction.UP:
				activeObject.setTop(activeObject.getTop() - STEP);
				break;
			  case Direction.RIGHT:
				activeObject.setLeft(activeObject.getLeft() + STEP);
				break;
			  case Direction.DOWN:
				activeObject.setTop(activeObject.getTop() + STEP);
				break;
			}
			activeObject.setCoords();
			canvas.renderAll();
			//console.log('selected objects was moved');
			set_object_pos();
		} else if (activeGroup) {
			switch (direction) {
			  case Direction.LEFT:
				activeGroup.setLeft(activeGroup.getLeft() - STEP);
				break;
			  case Direction.UP:
				activeGroup.setTop(activeGroup.getTop() - STEP);
				break;
			  case Direction.RIGHT:
				activeGroup.setLeft(activeGroup.getLeft() + STEP);
				break;
			  case Direction.DOWN:
				activeGroup.setTop(activeGroup.getTop() + STEP);
				break;
			}
			activeGroup.setCoords();
			canvas.renderAll();
			//console.log('selected group was moved');
		} else {
			//console.log('no object selected');
		}
	}
	/* align with arrow */
	
	// GROUP ON SELECTION
	canvas.on("selection:created", function(e) {
		var activeObj = canvas.getActiveObject();
		console.log(e.target );
	  if(activeObj.type === "activeSelection") {		
		group_layer = true;	
		property_object.find('.pg-property-widget').hide();
		element_background.hide();
		ed_remove_colorpicker();
		element_text.hide();
		element_ai_text.hide();
		element_overlay.hide();
		element_shape.hide();
		property_object.show();
		property_object.find('.pg-property-widget.edp_group_layer_option').show();
		property_object.find('.pg-property-widget.edp_layer_option').show();
		property_object.find('.pg-property-widget.edp_pos').show();	
		// var groupWidth = e.target.getWidth();
		// var groupHeight = e.target.getHeight();
		var groupWidth = e.target.width;
		var groupHeight = e.target.height;
		
		
		e.target.forEachObject(function(obj) {
			var itemWidth = obj.getBoundingRect().width;
			var itemHeight = obj.getBoundingRect().height;
			
			$('.ed_group_colorPicker').on('change', function(e) {
				var color =  $(this).val();	
				// var color = e.color.toString('rgba');
				console.log(color);
				$(this).next().css({
					'background-color':color
				});
				obj.set({
					fill:color
				});
				canvas.renderAll();
			});

			$('.ed_group_align_left').click(function() {
				obj.set({
					left: -(groupWidth / 2),
					originX: 'left'
				});
				obj.setCoords();
				canvas.renderAll();
			});$('.ed_group_align_top_v').click(function() {
				obj.set({
					top: -(groupHeight / 2),
					originY: 'top'
				});
				obj.setCoords();
				canvas.renderAll();
			});
			
			$('.ed_group_align_center').click(function() {
				obj.set({
					left: (0 - itemWidth/2),
					originX: 'left'
				});
				obj.setCoords();
				canvas.renderAll();
			});$('.ed_group_align_center_v').click(function() {
				obj.set({
					top: (0 - itemHeight/2),
					originY: 'top'
				});
				obj.setCoords();
				canvas.renderAll();
			});
			
			$('.ed_group_align_right').click(function() {
				obj.set({
					left: (groupWidth/2 - itemWidth/2),
					originX: 'center'
				});
				obj.setCoords();
				canvas.renderAll();
			});$('.ed_group_align_bottom_v').click(function() {
				obj.set({
					top: (groupHeight/2 - itemHeight/2),
					originY: 'center'
				});
				obj.setCoords();
				canvas.renderAll();
			});
		  
		});
			
	  }
	}); // END OF " SELECTION:CREATED "

	canvas.on("selection:cleared", function(e) {
		$('.ed_group_align_top_v').off('click');
		$('.ed_group_align_center_v').off('click');
		$('.ed_group_align_bottom_v').off('click');
		$('.ed_group_align_left').off('click');
		$('.ed_group_align_center').off('click');
		$('.ed_group_align_right').off('click');
		$('.ed_group_colorPicker').off('change');
		group_layer = false;
	});
	
	$(function() {
		/* Editor sidebar draggable start */
		$( ".pg-editor-body .pg-sidebar-wrapper" ).draggable({handle: ".pg-sidebar-toggle", containment: "body"});
		/* Editor sidebar draggable end */
		
		$('#pg_canvas_gradient_radius').val(canvas_width);
		$('#pg_canvas_gradient_radius').attr('max',canvas_width);
		/* custom scroll bar start */
		if($(".pg-custom-scrollbar").length){
			$(".pg-custom-scrollbar").mCustomScrollbar({
				scrollInertia:200,
			});
		}
		if($(".pg-custom-scrollbar_x").length){
			$(".pg-custom-scrollbar_x").mCustomScrollbar({
				scrollInertia:200,
				axis:"x"
			});
		}
		/* custom scroll bar end */
		jQuery(".ed_zoom_in").on('click',function(d) {
			var f = parseFloat(jQuery(".ed_zoom_value").val()) / 100 || 1;
			f += 0.1;
			zoomTo(f);
		});
		jQuery(".ed_zoom_out").on('click',function(d) {
			var f = parseFloat(jQuery(".ed_zoom_value").val()) / 100 || 1;
			f -= 0.1;
			zoomTo(f);
		});
		jQuery(".ed_zoom_reset").on('click',function(d) {
			zoomTo(1);
		});
		jQuery(document).on('keydown',function(e) {
			var d = canvas.getActiveObject() || canvas.getActiveGroup();
			if (d && e.keyCode == 46 && !jQuery("#pg_canvas_textarea").is(":focus") && !jQuery("input").is(":focus") && !jQuery("textarea").is(":focus")) {
				e.preventDefault();
				$('.ed_delete_layer').click();
			}
			
			var key = e.which || e.keyCode; // key detection
			if (key === 37  && !jQuery("#pg_canvas_textarea").is(":focus") && !jQuery("input").is(":focus") && !jQuery("textarea").is(":focus")) { // handle Left key
				moveSelected(Direction.LEFT);
			} else if (key === 38  && !jQuery("#pg_canvas_textarea").is(":focus") && !jQuery("input").is(":focus") && !jQuery("textarea").is(":focus")) { // handle Up key
				moveSelected(Direction.UP);
			} else if (key === 39  && !jQuery("#pg_canvas_textarea").is(":focus") && !jQuery("input").is(":focus") && !jQuery("textarea").is(":focus")) { // handle Right key
				moveSelected(Direction.RIGHT);
			} else if (key === 40  && !jQuery("#pg_canvas_textarea").is(":focus") && !jQuery("input").is(":focus") && !jQuery("textarea").is(":focus")) { // handle Down key
				moveSelected(Direction.DOWN);
			}
			
			if(e.keyCode == 90 && e.ctrlKey){
				history_undo();
			}
			if(e.keyCode == 89 && e.ctrlKey){
				history_redo();
			}
		});
			$(document).on('click','#save_template',function(e){
			e.preventDefault();
			var data = {};
			var m = canvas.toDataURL({format: "jpg"});
			data['thumb'] = m;	
			canvas.width = canvas_width;
			canvas.height = canvas_height;
			data['template_data'] = JSON.stringify(canvas.toJSON(properties_to_save));
			data['template_id'] = $('#template_id').val();
			data['campaign_id'] = $('#campaign_id').val();
			$('.ed_preloader ').show();
			$('.pg-preloader-wrap').css('display','flex');
			$.ajax({
				url: ajaxurl + 'editor/save_template', 
				type: "POST",         
				data: data, 
				success: function(data){
					var result = jQuery.parseJSON(data);
					if(result.status){
						if(admin !== true && result.access_level >= 2){
							image_data = result.thumb;
							setCookie('fb_thumb', result.thumb, 1);
							setCookie('fb_size', result.size, 1);
							$('.popup_hidden_btn').trigger('click');
						}
						$.toaster(result.msg, 'Success', 'success');
						Unsaved = false;
					}else{
						$.toaster(result.msg, 'Error', 'error');
					}
					$('.pg-preloader-wrap').hide();
				}
			});
		});
// 		$(document).on('click','#save_template',function(e){
// 			e.preventDefault();
// 			var data = {};
// 			var m = canvas.toDataURL({format: "jpg"});
// 			data['thumb'] = m;	
// 			canvas.width = canvas_width;
// 			canvas.height = canvas_height;
//             data['template_data'] = '';  
// 			data['template_id'] = $('#template_id').val();
// 			data['campaign_id'] = $('#campaign_id').val();
// 			$('.pg-preloader-wrap').css('display','flex');
// 			$.ajax({
// 				url: ajaxurl + 'editor/save_template', 
// 				type: "POST",         
// 				data: data, 
// 				success: function(data){
// 					var result = jQuery.parseJSON(data);
// 				    if(result.status){
// 						/** 
// 						 * Template Data save
// 						 */
// 						let data_tem = {};
// 						data_tem['template_data'] = JSON.stringify(canvas.toJSON(properties_to_save));
// 						data_tem['template_id'] = $('#template_id').val();
// 						data_tem['campaign_id'] = $('#campaign_id').val();
// 						$.ajax({
// 							url: ajaxurl + 'editor/save_template', 
// 							type: "POST",         
// 							data: data_tem, 
// 							success: function(data){
// 								var result = jQuery.parseJSON(data);
//                                 if(result.status){
//                                     if(admin !== true && result.access_level >= 2){
// 										image_data = result.thumb;
// 										setCookie('fb_thumb', result.thumb, 1);
// 										setCookie('fb_size', result.size, 1);
// 										$('.popup_hidden_btn').trigger('click');
// 									}
// 									$.toaster(result.msg, 'Success', 'success');
// 								}

// 							}
// 						});
// 						Unsaved = false;
// 					}else{
// 						$.toaster(result.msg, 'Error', 'error');
// 					} 
// 					$('.pg-preloader-wrap').hide();
// 				}
// 			});
// 		});
		$(document).on('click','.pg-element-svg',function(e){
			e.preventDefault();
			var file = $(this).find('img').attr('src');
			$.get(file, function(data) {
			   load_svg_from_string(data);
			}, 'text');

		});	
		$(document).on('click','.ed_clip_circle',function(e){
			e.preventDefault();
			var obj = canvas.getActiveObject();
			if (!obj) return;
			var clip = $(this).data('clip');
			if (clip == 'default') {
				obj.clipTo = null;
			}
			if(clip == 'circle'){
				obj.clipTo = function (ctx) {var radius = this.width < this.height ? (this.width / 2) : (this.height / 2);ctx.arc(0, 0, radius, 0, Math.PI * 2, true);};
			}
			if(clip == 'square'){
				obj.clipTo = function (ctx) {var w = this.width < this.height ? this.width : this.height;ctx.rect(-w/2, -w/2, w, w);};
			}
			if(clip == 'diamond'){
				obj.clipTo = function (ctx) {
					var w = this.width < this.height ? this.width : this.height;
					ctx.beginPath();
					var rect = new fabric.Rect({
							fill: 'rgba(38,185,154,0)',
							angle:45,
							left: -w/2,
							top: -w/2,
							width: w,
							height: w
					});
					rect.render(ctx);
				};
			}			
			canvas.renderAll();
		});	

		
		$(document).on('click','.ed_bg_pattern',function(e){
			e.preventDefault();
			$('.ed_bg_pattern').removeClass('active');
			var file = $(this).find('img').attr('src');
			var html = '', color = '';
			$(this).addClass('active');

			$('.ed_pattern_colorpicker').find('.pg-colorPicker-container').remove();
			$.get(file, function(data) {
				$('.ed_pattern_svg').html(data);
				var path = fabric.loadSVGFromString(data,function(objects, options) {
					for(var i=0;i<objects.length;i++){
						color = objects[i].fill;
						html = '<div class="pg-colorPicker-container" data-index="'+i+'">';

							html += '<input type="text" class="pg_colorPicker input-group-addon 1" value="'+color+'" /><span class="color_viewer 1" style="background-color: '+color+';"></span>';
						html += '</div>';
						$('.ed_pattern_colorpicker').append(html);
					}
					bootstrap_colorpicker_js('pattern');
					$('.pg_colorPicker').parent().css("color", color);
				});		
			}, 'text');
			set_background_pattern( file, '' );	
		});	
		$('.get_canvas_image').on('click',function(e){
		    var b = canvas.width;
			var scalefactor = b / canvas.getWidth();
			var format = $(this).data('format');
			canvas.loadFromJSON(JSON.stringify(canvas), function() {
				var m = canvas.toDataURL({
							format: 'jpeg',
							quality: 0.8
						});
				var ex = '';
				if(format=='image/png'){
					ex = 'png';
				}else{
					ex = 'jpg';
				}
				var ad = $("<a>").attr("href", m).attr("download", "template."+ex).appendTo("body");
				ad[0].click();				  
				ad.remove();
			});
		});
		$(document).on('click','.pg-add-text',function(e){	
			var f = canvas_width / 2 - 82;
			var d = canvas_height / 2 - 14;
			var g = new fabric.IText($(this).data('text'), {
				left: f,
				top: d,
				originX: "center",
				originY: "center",
				fontFamily: $(this).data('family'),
				fontSize: $(this).data('size'),
				fill: $(this).data('fill'),
				fontWeight: $(this).data('weight'),
				lineHeight: $(this).data('lineheight'),
				fontStyle: $(this).data('fontstyle'),
				textDecoration: $(this).data('textdecoration'),
				textAlign: $(this).data('textalign')
			});
			canvas.add(g);
			canvas.renderAll();
		});	
		jQuery('.pg-editor-aside-nav ul li a').on('click',function(){
			var cls = $(this).data('element');
			$('.pg-hidden-element').hide();
			jQuery('.pg-editor-aside-nav ul li a').removeClass('active');
			property_object.find('.pg-property-widget').hide();
			$('.'+cls).show();
			$(this).addClass('active');
		});
		jQuery("#pg_canvas_textarea").on('keyup',function(d) {
			var f = jQuery(this).val();
			canvas.getActiveObject().set("text", f);
			canvas.renderAll();
		});
		jQuery(document).on('keyup', '.pg_canvas_svg_textarea', function(d){
			var f = jQuery(this).val();
			var index = jQuery(this).data('index');
			canvas.getActiveObject().paths[index].set("text", f);
			canvas.renderAll();
		});
		jQuery(document).on('change', '.pg_canvas_svg_fontfamily', function(d){
			var f = jQuery(this).val();
			var index = jQuery(this).parent().data('index');
			canvas.getActiveObject().paths[index].set("fontFamily", f);
			canvas.renderAll();
		});
		jQuery(document).on('change', '.ed_svg_font_size', function(d){
			var f = jQuery(this).val();
			var index = jQuery(this).parent().data('index');
			canvas.getActiveObject().paths[index].set("fontSize", f);
			canvas.renderAll();
		});
		jQuery(document).on('change', '.ed_svg_font_linehight', function(d){
			var f = jQuery(this).val();
			var index = jQuery(this).parent().data('index');
			canvas.getActiveObject().paths[index].set("lineHeight", f);
			canvas.renderAll();
		});
		jQuery(document).on('click', '.ed_svg_text_align', function(d){
			if(!canvas.getActiveObject()) return false;
			jQuery(".ed_svg_text_align").removeClass('active');
			var index = jQuery(this).parents('ul').data('index');
			if (jQuery(this).hasClass("txt_alignleft")) {
				canvas.getActiveObject().paths[index].set("textAlign", "left")
			}
			if (jQuery(this).hasClass("txt_aligncenter")) {
				canvas.getActiveObject().paths[index].set("textAlign", "center")
			}
			if (jQuery(this).hasClass("txt_alignright")) {
				canvas.getActiveObject().paths[index].set("textAlign", "right")
			}
			jQuery(this).addClass('active');
			canvas.renderAll();
		});
		jQuery(document).on('click', '.ed_svg_text_decoration', function(d){
			if(!canvas.getActiveObject()) return false;
			var index = jQuery(this).parents('ul').data('index');
			if (jQuery(this).hasClass("active")) {
				canvas.getActiveObject().paths[index].set("textDecoration", "normal");
				jQuery(this).removeClass("active");
				canvas.renderAll();
				return false;
			}
			jQuery(".ed_text_decoration").removeClass('active');
			if (jQuery(this).hasClass("txt_underlined")) {
				canvas.getActiveObject().paths[index].set("textDecoration", "underlined");
			}
			if (jQuery(this).hasClass("txt_linethrough")) {
				canvas.getActiveObject().paths[index].set("textDecoration", "line-through");
			}
			if (jQuery(this).hasClass("txt_overline")) {
				canvas.getActiveObject().paths[index].set("textDecoration", "overline");
			}
			jQuery(this).addClass('active');
			canvas.renderAll();
		});
		jQuery(document).on('click', '.ed_svg_fontweight', function(d){
			if(!canvas.getActiveObject()) return false;
			var index = jQuery(this).parents('ul').data('index');
			if (jQuery(this).hasClass("active")) {
				jQuery(this).removeClass('active');
				canvas.getActiveObject().paths[index].set("fontWeight", "normal");
			}else{
				jQuery(this).addClass('active');
				canvas.getActiveObject().paths[index].set("fontWeight", "bold");
			}
			canvas.renderAll();
		});
		jQuery(document).on('click', '.ed_svg_fontstyle', function(d){
			if(!canvas.getActiveObject()) return false;
			var index = jQuery(this).parents('ul').data('index');
			if (jQuery(this).hasClass("active")) {
				jQuery(this).removeClass('active');
				canvas.getActiveObject().paths[index].set("fontStyle", "normal");
			}else{
				jQuery(this).addClass('active');
				canvas.getActiveObject().paths[index].set("fontStyle", "italic");
			}
			canvas.renderAll();
		});		
		
		// jQuery("#pg_canvas_fontfamily").on('change',function(e) {
		// 	console.log($(this).val());
		// 	canvas.getActiveObject().set("fontFamily", $(this).val());
        //     canvas.renderAll();
		// });
		
		jQuery("#pg_canvas_fontfamily").on('change', function(e) {
			var selectedFontFamily = $(this).val();
			
			console.log('Selected Font Family:', selectedFontFamily);
			$(this).css("font-family", selectedFontFamily);
			var activeObject = canvas.getActiveObject();
			
			if (activeObject && activeObject.type === 'i-text') {
				activeObject.set("fontFamily", selectedFontFamily);
				
				// Trigger a redraw of the canvas
				//canvas.renderAll();
				canvas.renderAll.bind(canvas)();
				console.log('Font Family Updated Successfully');
			} else {
				console.warn('No active text object found or the selected object is not a text object.');
			}
		});
         
		jQuery("#ed_font_size").on('change',function() {
			var d = parseInt(jQuery(this).val());
			if (d < 4) {
				d = 4
			}
			canvas.getActiveObject().set("fontSize", d);
			canvas.renderAll();
		});
		/* range slider start */
		$('.pg_range_slider input#txt_opacity').on('input', function(){
			var v = $(this).val();
			var n_v = v +'%';
			$(this).prev().children().val(n_v);
			if($(this).data('gradient') == undefined){
				jQuery("#ed_object_opacity").change();
			}else if($(this).data('gradient') == 1){
				set_background_gradient();
			}
		});
		$('.pg_range_slider input#pg_canvas_gradient_angle,.pg_range_slider input#pg_canvas_gradient_radius').on('input', function(){
			var v = $(this).val();
			var n_v = v +'%';
			$(this).prev().children().val(n_v);
			set_background_gradient();
		});
		/* range slider end */
		jQuery("#ed_object_opacity").on('change',function() {
			var d = parseInt(jQuery(this).val()) / 100;
			if (d > 1) {
				d = 1
			}
			if (d < 0) {
				d = 0
			}
			if (canvas.getActiveObject()) {
				canvas.getActiveObject().set("opacity", d);
				canvas.renderAll();
			}else if (canvas.backgroundImage) {
				canvas.backgroundImage.set("opacity", d);
				canvas.renderAll();
			}
			DEBUG && console.log("object-opacity change: " + d)
		});
		jQuery("#ed_object_rotation_angle").change(function() {
			var d = parseInt(jQuery(this).val());
			if (d > 360) {
				d -= 360
			}
			if (d < -360) {
				d += 360
			}
			canvas.getActiveObject().set("angle", d).setCoords();
			canvas.renderAll();
		});
		jQuery("#ed_object_x_position").on('change',function() {
			var d = canvas.getActiveObject() || canvas.getActiveGroup();
			if (!d) {
				return
			}
			var f = parseInt(jQuery(this).val());
			if (d.originX == "center") {
				d.set("left", f + d.getWidth() / 2).setCoords()
			} else {
				d.set("left", f).setCoords()
			}
			canvas.renderAll();
		});
		jQuery("#ed_object_y_position").on('change',function() {
			var f = canvas.getActiveObject() || canvas.getActiveGroup();
			if (!f) {
				return
			}
			var d = parseInt(jQuery(this).val());
			if (f.originY == "center") {
				f.set("top", d + f.getHeight() / 2).setCoords()
			} else {
				f.set("top", d).setCoords()
			}
			canvas.renderAll();
		});
		jQuery("#ed_font_linehight").on('change',function() {
			var d = parseFloat(jQuery(this).val());
			d = +d.toFixed(1);
			if (d < 0) {
				d = 0
			}
			canvas.getActiveObject().set("lineHeight", d);
			canvas.renderAll();
		});
		jQuery(".ed_text_align").on('click',function(d) {
			if(!canvas.getActiveObject()) return false;
			jQuery(".ed_text_align").removeClass('active');
			if (jQuery(this).hasClass("txt_alignleft")) {
				canvas.getActiveObject().set("textAlign", "left")
			}
			if (jQuery(this).hasClass("txt_aligncenter")) {
				canvas.getActiveObject().set("textAlign", "center")
			}
			if (jQuery(this).hasClass("txt_alignright")) {
				canvas.getActiveObject().set("textAlign", "right")
			}
			jQuery(this).addClass('active');
			canvas.renderAll();
		});
		jQuery(".ed_text_decoration").on('click',function(d) {
			if(!canvas.getActiveObject()) return false;
			if (jQuery(this).hasClass("active")) {
				canvas.getActiveObject().set("textDecoration", "normal");
				jQuery(this).removeClass("active");
				canvas.renderAll();
				return false;
			}
			jQuery(".ed_text_decoration").removeClass('active');
			if (jQuery(this).hasClass("txt_underlined")) {
				canvas.getActiveObject().set("textDecoration", "underlined");
			}
			if (jQuery(this).hasClass("txt_linethrough")) {
				canvas.getActiveObject().set("textDecoration", "line-through");
			}
			if (jQuery(this).hasClass("txt_overline")) {
				canvas.getActiveObject().set("textDecoration", "overline");
			}
			jQuery(this).addClass('active');
			canvas.renderAll();
		});
		jQuery(".ed_fontweight").on('click',function(d) {
			if(!canvas.getActiveObject()) return false;
			if (jQuery(this).hasClass("active")) {
				jQuery(this).removeClass('active');
				canvas.getActiveObject().set("fontWeight", "normal");
			}else{
				jQuery(this).addClass('active');
				canvas.getActiveObject().set("fontWeight", "bold");
			}
			canvas.renderAll();
		});
		jQuery(".ed_fontstyle").on('click',function(d) {
			if(!canvas.getActiveObject()) return false;
			if (jQuery(this).hasClass("active")) {
				jQuery(this).removeClass('active');
				canvas.getActiveObject().set("fontStyle", "normal");
			}else{
				jQuery(this).addClass('active');
				canvas.getActiveObject().set("fontStyle", "italic");
			}
			canvas.renderAll();
		});
		jQuery('.ed_js_color').on('click',function(e){
			e.preventDefault();
			jQuery('.ed_js_color').removeClass('active');
			var color = jQuery(this).data('color');
			jQuery(this).addClass('active');
			set_background_color(color);

			//$('#pg_canvas_background_picker').colorpicker('setValue',color);.

		});
        /*
		$('#pg_canvas_background_picker').colorpicker({
			customClass: 'colorpicker-2x',
			align: 'left',
			sliders: {
				saturation: {
					maxLeft: 200,
					maxTop: 200
				},
				hue: {
					maxTop: 200
				},
				alpha: {
					maxTop: 200
				}
			}
		});*/
        /**
		 * Coloris
		 */
		Coloris({
			el: '#pg_canvas_background_picker',
			swatches: [
			'#264653',
			'#2a9d8f',
			'#e9c46a',
			'#f4a261',
			'#e76f51',
			'#d62828',
			'#023e8a',
			'#0077b6',
			'#0096c7',
			'#00b4d8',
			'#48cae4'
			]
		}); 
		$('#pg_canvas_background_picker').on('change', function(e) {
			var color = $(this).val(); //e.color.toString('rgba');
			$(this).next().css({
				'background-color':color
			});
			set_background_color(color);
		});
 
		/*
		$('.pg_canvas_gradient_picker').colorpicker({
			customClass: 'colorpicker-2x',
			align: 'left',
			sliders: {
				saturation: {
					maxLeft: 200,
					maxTop: 200
				},
				hue: {
					maxTop: 200
				},
				alpha: {
					maxTop: 200
				}
			}
		});*/
		Coloris({
			el: '.pg_canvas_gradient_picker',
			swatches: [
			'#264653',
			'#2a9d8f',
			'#e9c46a',
			'#f4a261',
			'#e76f51',
			'#d62828',
			'#023e8a',
			'#0077b6',
			'#0096c7',
			'#00b4d8',
			'#48cae4'
			]
		});

        $('.pg_canvas_gradient_picker').on('change', function(e) {
			var color = $(this).val(); //e.color.toString('rgba');
			$(this).next().css({
				'background-color':color
			});
			set_background_gradient();
		});
        
        $('#linear_gradient').on('click',function(){
			$('.pg-property-widget.color_size,.pg-property-widget.gradient_radius').hide();
			$('.pg-property-widget.gradient_angle').show();
			$('.ed_grad_color').each(function(){
				var color1 = $(this).data('color1');
				var color2 = $(this).data('color2');
				$(this).css({
					'background' : 'linear-gradient(-0deg, '+color1+', '+color2+')'
				});
			});
			set_background_gradient();
		});
		$('#radial_gradient').on('click',function(){
			$('.pg-property-widget.gradient_angle,.pg-property-widget.color_size').hide();
			$('.pg-property-widget.gradient_radius').show();
			$('.ed_grad_color').each(function(){
				var color1 = $(this).data('color1');
				var color2 = $(this).data('color2');
				$(this).css({
					'background' : 'radial-gradient('+color1+', '+color2+')'
				});
			});
			set_background_gradient();
		});
		$('.ed_grad_color').on('click',function(e){
			e.preventDefault();
			var color1 = $(this).data('color1');
			var color2 = $(this).data('color2');
			$('#pg_canvas_gradient_picker_1').val(color1);
			$('#pg_canvas_gradient_picker_2').val(color2);
			$('#pg_canvas_gradient_picker_2').change();
			$('#pg_canvas_gradient_picker_1').change();
			set_background_gradient();
		}); 
		/**
		 * Start Image Color Overlay
		 */
		$('#pd_add_overlay').on('click',function(e){
			// Create a colored rectangle for the overlay
			const colorOverlay = new fabric.Rect({
				left: canvas.getWidth() / 2,
				top: canvas.getHeight() / 2,
				width: 300,
				height: 300,
				originX: "center",
				originY: "center",
				fill: '#000', // Initial color
				opacity: 0.5 // Adjust opacity as needed
			  });
		      colorOverlay.center().setCoords();
			  canvas.add(colorOverlay).renderAll();
		});
		/** 
		 * End Image Color Overlay
		 */
		$('.ed_upload_bg_file').on('change',function(e){
			e.preventDefault();
			var ext = $(this).val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
				return false;
			}
			$('.pg_canvas_preloader').removeClass('hide');
			upload_image($(this)[0].files[0], 'bg');
			$(this).val('');
		});
		$('.pg-upload-img-file-editor').on('change',function(e){
			e.preventDefault();
			var ext = $(this).val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
				$('.upoadFileError').html('<p style="color:red;" id="uploadFileError">Please upload only JPG/PNG/JPEG file is allowed</p>');
				// $.toaster('Please upload only JPG/PNG/JPEG file is allowed', 'Error');
				setTimeout(function(){
					$('#uploadFileError').remove();
				},3000);
				return false;
			}
			$('.pg_canvas_preloader').removeClass('hide');
			upload_image($(this)[0].files[0], 'image');
			$(this).val('');
		});
		$(document).on('click', '.pg_canvas_bg_image', function(e){
			e.preventDefault();
			var url = $(this).data('url');
			$('.pg_canvas_preloader').removeClass('hide');
			edit_bg_crop_image(url);
			set_canvas_bg(url);	
		});

    	$(document).on('click', '.pg_canvas_pixabay_image', function(e){
			e.preventDefault();
			var url = $(this).data('url');
			var cls = $(this).data('cls');
			$('.pg_canvas_preloader').removeClass('hide');
			var crossOriginImageObj = new Image();
			crossOriginImageObj.crossOrigin = "Anonymous";
			crossOriginImageObj.src = url;
			crossOriginImageObj.onerror = function() { console.log("cross-origin image load error"); }
			crossOriginImageObj.onload = function() {
				/* Add image to canvas */
				if(cls == 'image'){
					var j = crossOriginImageObj;
					var p = new fabric.Image(j, {});
					var m = j.width;
					var l = canvas.width;
					var n = 1;
					if (j.width > canvas.width || j.height > canvas.height) {
						j.width > j.height ? m = j.width : m = j.height;
						canvas.width > canvas.height ? l = canvas.width : l = canvas.height;
						n = l / m / 2
					}
					p.scale(n);
					p.orig_src = j.src;
					p.crossOrigin = 'Anonymous';
					canvas.centerObject(p);
					canvas.add(p);
					canvas.renderAll();
					$('.pg_canvas_preloader').addClass('hide');
				}else if(cls == 'bg'){
					var b = new fabric.Image( crossOriginImageObj, {});
					b.set({
						originX: "left",
						originY: "top"
					});
					var c = parseInt(canvas.width) / parseInt(b.getWidth());
					b.scale(c);
					if (canvas.getHeight() > b.getHeight()) {
						b.scaleToHeight(canvas.getHeight())
					}
					b.crossOrigin = 'Anonymous';
					b.left = (canvas.getWidth() - b.getWidth()) / 2;
					b.top = (canvas.getHeight() - b.getHeight()) / 2;
					canvas.setBackgroundImage(b, canvas.renderAll.bind(canvas));
					$('.pg_canvas_preloader').addClass('hide');
					edit_bg_crop_image(url);
				}		
			}
		});
		$(document).on('click', '.pg_canvas_add_image', function(e){
			e.preventDefault();
			$('.pg_canvas_preloader').removeClass('hide');
			var url = $(this).data('url');
			
			if(canvas.getActiveObject() && 'image' == canvas.getActiveObject().type){
				var j = new Image();
				j.src = url;
				j.onload = function() {
					var p = new fabric.Image(j);
					var m = j.width;
					var l = canvas.getActiveObject().getWidth();
					var n = 1;
					var w = canvas.getActiveObject().getWidth();
					var h = canvas.getActiveObject().getHeight();
					if (j.width > w || j.height > h) {
						j.width > j.height ? m = j.width : m = j.height;
						w > h ? l = w : l = h;
						n = l / m;
					}
					p.scale(n);
					p.orig_src = j.src;
					p.left = canvas.getActiveObject().left;
					p.top = canvas.getActiveObject().top;
					p.angle = canvas.getActiveObject().angle;
					p.opacity = canvas.getActiveObject().opacity;
					//p.crossOrigin="Anonymous" 
					canvas.insertAt(p, canvas.getObjects().indexOf(canvas.getActiveObject()));
					canvas.remove(canvas.getActiveObject());
					canvas.setActiveObject(p);
					canvas.renderAll();
					$('.pg_canvas_preloader').addClass('hide');
				}
				$('.pg_canvas_preloader').addClass('hide');
				return;
			}
			
			canvas_add_image(url, 0, 0);
		});
		$('.pg-load-more-wrap_my_image').on('click',function(e){
			e.preventDefault();
			var page = $(this).data('page');
			$.ajax({
				url: ajaxurl + 'editor/more_images', 
				type: "POST",         
				data: {	'page' : page },
				success: function(data){
					var result = jQuery.parseJSON(data);
					if(result.status){
						jQuery.each(result.data, function(k, v) {
							$('.pg-image-list.pg-recent-uploaded.bg').append('<div class="pg-imglist-item"><div class="ed_image pg_canvas_bg_image" data-url="'+ajaxurl+v.image_url+'"><img src="'+ajaxurl+v.thumb_url+'" alt=""></div><span class="pg-remove-image pg_canvas_bg_remove_image" data-id="'+v.id+'"></span></div>');
							$('.pg-image-list.pg-recent-uploaded.image').append('<div class="pg-imglist-item"><div class="ed_image pg_canvas_add_image" data-url="'+ajaxurl+v.image_url+'"><img src="'+ajaxurl+v.thumb_url+'" alt=""></div><span class="pg-remove-image pg_canvas_add_remove_image" data-id="'+v.id+'"></span></div>');
						});
						$('.pg-load-more-wrap_my_image').data('page', page + 1);
					}else{
						$('.pg-load-more-wrap_my_image').hide();
					}
				}
			});
		});
		$(document).on('click', '.pg_canvas_bg_remove_image,.pg_canvas_add_remove_image', function(e){
			e.preventDefault();
			if(confirm('Are you sure?')){
				var id = $(this).data('id');
				var index = $(this).parent().index();
				$.ajax({
					url: ajaxurl + 'editor/deleteimage', 
					type: "POST",         
					data: {	'id' : id, 'delete' : 'confirm' },
					success: function(data){
						var result = jQuery.parseJSON(data);
						if(result.result){
							$('.pg-image-list.pg-recent-uploaded.bg').children().eq(index).remove();
							$('.pg-image-list.pg-recent-uploaded.image').children().eq(index).remove();
						}
					}
				});
			}
		});
		jQuery(".ed_lock_layer").on('click',function() {
			if(canvas.getActiveObject().lockMovementX && canvas.getActiveObject().lockMovementY){
				canvas.getActiveObject().lockMovementX = false;
				canvas.getActiveObject().lockMovementY = false;
				canvas.getActiveObject().lockRotation  = false;
				canvas.getActiveObject().lockScalingX  = false;
				canvas.getActiveObject().lockScalingY  = false;
			}else{
				canvas.getActiveObject().lockMovementX = true;
				canvas.getActiveObject().lockMovementY = true;
				canvas.getActiveObject().lockRotation  = true;
				canvas.getActiveObject().lockScalingX  = true;
				canvas.getActiveObject().lockScalingY  = true;
			}
			canvas.renderAll();
		});
		jQuery(".ed_delete_layer").on('click',function() {
			if (canvas.getActiveObject()) {
				if (canvas.getActiveObject().group) {
					canvas.getActiveObject().group.remove(canvas.getActiveObject());
					canvas.renderAll();
				} else {
					canvas.remove(canvas.getActiveObject());
				}
			}
			if(canvas.getActiveGroup()){
				let selection = _getSelection();
				canvas.discardActiveGroup();
				selection.forEach(obj => obj.remove());
				canvas.renderAll();
			}
			save_history(1);
			$('#main_tab_text').click();
		});
		jQuery(".ed_bring_forward").on('click',function() {
			if (canvas.getActiveObject()) {
				canvas.getActiveObject().bringForward();
			}
		});
		jQuery(".ed_send_backword").on('click',function() {
			var d = canvas.getObjects().indexOf(canvas.getActiveObject());
			if (d > 0) {
				canvas.getActiveObject().sendBackwards();
			}
		});
		jQuery(".ed_bring_front").on('click',function() {
			if (canvas.getActiveObject()) {
				canvas.getActiveObject().bringToFront();
			}
		});
		jQuery(".ed_send_back").on('click',function() {
			var d = canvas.getObjects().indexOf(canvas.getActiveObject());
			if (d > 0) {
				canvas.getActiveObject().sendToBack();
			}
		});
		jQuery(".ed_center_horizontally").on('click',function() {
			if(canvas.getActiveGroup()){
				canvas.getActiveGroup().centerH();
			}
			if (canvas.getActiveObject()) {
				canvas.getActiveObject().centerH();
			}
		});
		jQuery(".ed_center_vertically").on('click',function() {
			if(canvas.getActiveGroup()){
				canvas.getActiveGroup().centerV();
			}
			if (canvas.getActiveObject()) {
				canvas.getActiveObject().centerV();
			}
			
		});
		jQuery(".ed_flip_horizontally").on('click',function() {
			if(canvas.getActiveGroup()){
				canvas.getActiveGroup().toggle('flipX');
				canvas.renderAll();
			}
			if (canvas.getActiveObject()) {
				canvas.getActiveObject().toggle('flipX');
				canvas.renderAll();
			}
			
		});
		jQuery(".ed_flip_vertically").on('click',function() {
			if(canvas.getActiveGroup()){
				canvas.getActiveGroup().toggle('flipY');
				canvas.renderAll();
			}
			if (canvas.getActiveObject()) {
				canvas.getActiveObject().toggle('flipY');
				canvas.renderAll();
			}
			
		});
		jQuery(".ed_element_copy").on('click',function() {
			if(canvas.getActiveGroup()){
				var f = canvas.getActiveGroup();
			}else if(canvas.getActiveObject()){
				var f = canvas.getActiveObject();
			}
			
			if (!f) {
				return;
			}
			if (f.type == "i-text") {
				var d = new fabric.IText("new text", {
					originX: "center",
					originY: "center"
				});
				d.text = f.text;
				d.fontFamily = f.fontFamily;
				d.fontSize = f.fontSize;
				d.textAlign = f.textAlign;
				d.textDecoration = f.textDecoration;
				d.fontWeight = f.fontWeight;
				d.fontStyle = f.fontStyle;
				d.lineHeight = f.lineHeight;
				d.opacity = f.opacity;
				d.fill = f.fill;
				d.backgroundColor = f.backgrdoundColor;
				d.angle = f.angle;
				d.height = f.height;
				d.width = f.width;
				d.scaleX = f.scaleX;
				d.scaleY = f.scaleY;
				d.left = f.left + f.left * 0.1;
				d.top = f.top + f.height + f.top * 0.1;
				canvas.add(d);
			} else {
				
				f.clone(function (o) {
					var vobj = o;
					if (vobj) {
						vobj.set({
							left: f.left + f.left * 0.1,
							top: f.top + f.top * 0.1
						});
						canvas.add(vobj);
					} else {
						alert("Sorry Object Not Initialized");
					}
				});
			}
			canvas.renderAll();
		});
		jQuery(".ed_obj_undo").on('click',function() {
			if (!jQuery(this).hasClass("pg-disabled")) {
				history_undo();
			}
		});
		jQuery(".ed_obj_redo").on('click',function() {
			if (!jQuery(this).hasClass("pg-disabled")) {
				history_redo();
			}
		});
		jQuery("#remove-bg-image").on('click',function(d) {
			d.preventDefault();
			canvas.backgroundImage = null;
			canvas.renderAll();
			save_history(1);
			$('#main_tab_text').click();
		});		
		Coloris({
			el: '.ed_group_colorPicker',
			swatches: [
			'#264653',
			'#2a9d8f',
			'#e9c46a',
			'#f4a261',
			'#e76f51',
			'#d62828',
			'#023e8a',
			'#0077b6',
			'#0096c7',
			'#00b4d8',
			'#48cae4'
			]
		});
		/* Gradient Color */
		
		$('.pg_range_slider #ed_gradient_color_angle').on('input', function(){
			var v = $(this).val();
			var n_v = v +'%';
			$(this).prev().children().val(n_v);
			var obj = canvas.getActiveObject();
			if (!obj) return;
			gradient_color(obj);
			canvas.renderAll();
		});
		/*
		$('#ed_gradient_color_colorPicker_1,#ed_gradient_color_colorPicker_2').colorpicker({
			customClass: 'colorpicker-2x',
			align: 'left',
			sliders: {
				saturation: {
					maxLeft: 200,
					maxTop: 200
				},
				hue: {
					maxTop: 200
				},
				alpha: {
					maxTop: 200
				}
			}
		});*/
		Coloris({
			el: '#ed_gradient_color_colorPicker_1',
			swatches: [
			'#264653',
			'#2a9d8f',
			'#e9c46a',
			'#f4a261',
			'#e76f51',
			'#d62828',
			'#023e8a',
			'#0077b6',
			'#0096c7',
			'#00b4d8',
			'#48cae4'
			]
		});
		Coloris({
			el: '#ed_gradient_color_colorPicker_2',
			swatches: [
			'#264653',
			'#2a9d8f',
			'#e9c46a',
			'#f4a261',
			'#e76f51',
			'#d62828',
			'#023e8a',
			'#0077b6',
			'#0096c7',
			'#00b4d8',
			'#48cae4'
			]
		});
		$('#ed_gradient_color_colorPicker_1,#ed_gradient_color_colorPicker_2').on('change', function(e) {
			var color = $(this).val(); //e.color.toString('rgba');
			$(this).next().css({
				'background-color':color
			});
			var obj = canvas.getActiveObject();
			if (!obj) return;
			var attr = $(this).attr('id');
			gradient_color(obj, color, attr);
			canvas.renderAll();
		});  
		$('#pg_gradient_color_enable').on('change',function(){
			var obj = canvas.getActiveObject();
			if (!obj) return;
			if($(this).is(':checked')){
				$('.pg_gradient_color_enable').removeClass('hide');
				gradient_color(obj);
			}else{
				$('.pg_gradient_color_enable').addClass('hide');
				var color = $('.edp_color').find('input').val();
				obj.set({"fill":color});	
			}
			canvas.renderAll();
		});
		
		/* Gradient Color */
		/* stroke */
		$('#pg_stroke_enable').on('change',function(){
			var obj = canvas.getActiveObject();
			if (!obj) return;
            if($(this).is(':checked')){
				$('.pg_stroke_enable').removeClass('hide');
				stroke(obj);
			}else{
				$('.pg_stroke_enable').addClass('hide');
				obj.set({
					stroke: null,
					strokeWidth: null
				});		
			}
			canvas.renderAll();
		});
		$('#pg_stroke_width').on('change',function(){
			var obj = canvas.getActiveObject();
			if (!obj) return;
			stroke(obj);
			canvas.renderAll();
		}); 
		/*
		$('#pg_stroke_colorPicker').colorpicker({
			customClass: 'colorpicker-2x',
			align: 'left',
			sliders: {
				saturation: {
					maxLeft: 200,
					maxTop: 200
				},
				hue: {
					maxTop: 200
				},
				alpha: {
					maxTop: 200
				}
			}
		});*/
		Coloris({
			el: '#pg_stroke_colorPicker',
			swatches: [
			'#264653',
			'#2a9d8f',
			'#e9c46a',
			'#f4a261',
			'#e76f51',
			'#d62828',
			'#023e8a',
			'#0077b6',
			'#0096c7',
			'#00b4d8',
			'#48cae4'
			]
		});
		$('#pg_stroke_colorPicker').on('change', function(e) {
			var color = $(this).val(); //e.color.toString('rgba');
			$(this).next().css({
				'background-color':color
			});
			var obj = canvas.getActiveObject();
			if (!obj) return;
			stroke(obj, color);
			canvas.renderAll();
		}); 
		$('#pg_stroke_colorPicker').mouseup(function(e) { 
			var color = $(this).val(); //e.color.toString('rgba');
			$(this).next().css({
				'background-color':color
			}); 
			var obj = canvas.getActiveObject();
			if (!obj) return;
			shadow(obj);
			canvas.renderAll();
		});
		/* stroke */
 
		/* shadow */
		/*
		$('#ed_shadow_enable').on('change',function(){
			var obj = canvas.getActiveObject();
			if (!obj) return;

			if($(this).is(':checked')){
				$('.ed_shadow_enable').removeClass('hide');
				shadow(obj);
			}else{
				$('.ed_shadow_enable').addClass('hide');
				obj.shadow = null;				
			}
			canvas.renderAll();
		});
		*/
		/*
		$('#ed_shadow_colorPicker').colorpicker({
			customClass: 'colorpicker-2x',
			align: 'left',
			sliders: {
				saturation: {
					maxLeft: 200,
					maxTop: 200
				},
				hue: {
					maxTop: 200
				},
				alpha: {
					maxTop: 200
				}
			}
		});
		*/
		Coloris({
			el: '#ed_shadow_colorPicker',
			swatches: [
			'#264653',
			'#2a9d8f',
			'#e9c46a',
			'#f4a261',
			'#e76f51',
			'#d62828',
			'#023e8a',
			'#0077b6',
			'#0096c7',
			'#00b4d8',
			'#48cae4'
			]
		}); 
		
		/*document.addEventListener('coloris:pick', event => {
			var color = event.detail.color; //e.color.toString('rgba');
			//let check_work =document.getElementById('ed_shadow_colorPicker').value=color;
			const check_work = document.getElementsByClassName('input-group-addon');
			for (let i = 0; i < elements.length; i++) {
				const element = elements[i];
				element.value = 'ajay';
			}
        });*/   
		
		$('#ed_shadow_offsetX,#ed_shadow_offsetY,#ed_shadow_blur').on('change',function(){
			var obj = canvas.getActiveObject();
			if (!obj) return;
			shadow(obj);
			canvas.renderAll();
		});  
        $('#ed_shadow_colorPicker').on('change', function(e) { 
			var color = $(this).val(); //e.color.toString('rgba');
			$(this).next().css({
				'background-color':color
			}); 
			var obj = canvas.getActiveObject();
			if (!obj) return;
			shadow(obj);
			canvas.renderAll();
		});
		$('#ed_shadow_colorPicker').mouseup(function(e) { 
			var color = $(this).val(); //e.color.toString('rgba');
			$(this).next().css({
				'background-color':color
			});
			var obj = canvas.getActiveObject();
			if (!obj) return;
			shadow(obj);
			canvas.renderAll();
		});
		/* shadow */

		/* Pixabay */
		$('.pixabay_search_image_key').on('keydown',function(e){
			var key = e.which || e.keyCode; // key detection
			if(key == 13){
				$(this).next().click();
			}
		});
		$('.pg-load-more-wrap_pixabay_image').on('click',function(e){
			e.preventDefault();
			var obj = $(this).prev().prev();
			var q = obj.find('.pixabay_search_image_key').val();
			var cls = obj.find('.pixabay_search_image').data('class');
			var page = $(this).data('page');
			$(this).data('page', page+1);
			call_api_pixabay(q, obj.find('.pixabay_search_image'), cls, page);
		});	
		$('.pixabay_search_image').on('click',function(){
			var q = $(this).prev().val();
			var cls = $(this).data('class');
			var page = $(this).data('page');
			$('.pg-load-more-wrap_pixabay_image').data('page', page+1);
			$(this).parents('.pg_search_box_sb').next('.ed_append_pixabay_'+cls).html('');
			call_api_pixabay(q, $(this), cls, page);
		});	
		/** 
		 * Pixabay 
		 * Template Size
		 */
		
		if($('#template_id').val() != ''){
			var template_id = $('#template_id').val();
			var sub_user_id = $('#user_id').val();
			$('.pg-canvas-holder').find('.canvas-container').append('<div class="pg_canvas_preloader"><div class="pg_canvas_preloader_inner"><span></span><span></span><span></span></div></div>');
			$.ajax({
				type:'post',
				url: ajaxurl + 'editor/get_object',
				data:{'template_id':template_id, 'sub_user_id':sub_user_id},
				success:function(data){
					
					var result = jQuery.parseJSON(data);
                    // console.log("xxxxxxxxxxxx",jQuery.parseJSON(result.data));
					if(result.status){
						var size = result.size;
						var size_arr = size.split('x');
						canvas_width = size_arr[0];
						canvas_height = size_arr[1];
						canvas.setWidth(canvas_width).setHeight(canvas_height);
						set_canvas_size(canvas_width, canvas_height);	 
						
						if(result.data != ''){ 
							let d1=jQuery.parseJSON(result.data).objects
                            for(let i=0;i<d1.length;i++)
							{
								if(d1[i].type=="image")
								{
									d1[i].crossOrigin="anonymous"
								}								
							}
							// result.data.objects=d1
							let d2=jQuery.parseJSON(result.data)
							d2.objects=d1
							result.data=JSON.stringify(d2)
							// console.log(result.data)
							canvas.loadFromJSON(result.data, function(){
								canvas.renderAll.bind(canvas);
								$('.pg_canvas_preloader').addClass('hide');
								history.lock = false;
							}, function(o, object) {
								//fabric.log(o, object);
							});
							canvas.width = canvas_width;
							canvas.height = canvas_height;
						}else{
							$('.pg_canvas_preloader').addClass('hide');
						}
						$('body').addClass('pg-site-loaded');
					}
				}
			});
		} 
		
		if ($(window).width() < 1441) {
			var f = 55/100;
			f += 0.1;
			zoomTo(f);
		}if ($(window).width() < 1601) {
			var f = 60/100;
			f += 0.1;
			zoomTo(f);
		}
		
	});
	$(window).on('load', function(){
		$('.change_image_btn').on('click', function(){
			$('#main_tab_upload').trigger('click');
		});
	});
	$(window).on('beforeunload', function(e) {
		if(Unsaved == true) {
			return 'You have unsaved stuff. Are you sure to leave?';
		}
	});
	$(window).resize(function(){
		if ($(window).width() < 1441) {
			var f = 55/100;
			f += 0.1;
			zoomTo(f);
		}if ($(window).width() < 1601) {
			var f = 60/100;
			f += 0.1;
			zoomTo(f);
		}
	});
	function call_api_pixabay(q, obj, cls, page){
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'https://pixabay.com/api/?key=4298772-5bcc33553ad61ce64e43177ae&response_group=high_resolution&q='+encodeURIComponent(q)+'&pretty=true&safesearch=true&page='+page);
		xhr.onreadystatechange = function(){
			if (this.status == 200 && this.readyState == 4) {
				var data = JSON.parse(this.responseText);
				if (!(data.totalHits > 0)) {
					console.log('Try different keyword');
					return false;
				}
				render_pixabay_results(q, obj, data, cls, page);
			}
		};
		xhr.send();
		return false;
	}
	function render_pixabay_results(q, obj, data, cls, page){
		var html = '';
		jQuery.each(data.hits, function(k, v) {
			html = '';
			html += '<div class="pg-imglist-item">';
				html += '<div class="ed_image pg_canvas_pixabay_image" data-url="'+v.largeImageURL+'" data-user="'+v.user+'" data-w="'+v.webformatWidth+'" data-h="'+v.webformatHeight+'" data-cls="'+cls+'">';
					html += '<img src="'+v.previewURL.replace('_80', '_80')+'" alt="">';
				html += '</div>';
			html += '</div>';
			obj.parents('.pg_search_box_sb').next('.ed_append_pixabay_'+cls).append(html);
		});	
		obj.parents('.pg_search_box_sb').next('.ed_append_pixabay_'+cls).next().removeClass('hide');
	}
	function save_history(b) {
		if (history.lock != true) {			
			var json = canvas.toJSON();
            if (history.mods > 0) {
                history.state = history.state.slice(0, history.state.length - history.mods);
                history.mods = 0
            }
            history.state.push(json);
            updateBtnsStyle();
			Unsaved = true;
		}
	}
	function history_redo() {
		if (history.mods > 0) {
            loadState(history.state[history.state.length - history.mods]);
            history.mods -= 1;
            updateBtnsStyle();
        }
	}
	function history_undo() {
		if (history.mods < history.state.length - 1) {
            loadState(history.state[history.state.length - history.mods - 2]);
            history.mods += 1;
            updateBtnsStyle();
        }
	}
	function loadState(state) {
		history.lock = true;
        canvas.clear().renderAll();
        canvas.loadFromJSON(state, function () {
            canvas.renderAll();
			history.lock = false;
        });
    }
	function updateBtnsStyle() {
        if ((history.mods < history.state.length - 1)) {
			jQuery(".ed_obj_undo").removeClass("pg-disabled");
        } else {
			jQuery(".ed_obj_undo").addClass("pg-disabled");
        }
        if (history.state.length > 1 && history.mods > 0) {
			jQuery(".ed_obj_redo").removeClass("pg-disabled");
        } else {
            jQuery(".ed_obj_redo").addClass("pg-disabled");
        }
    }
	function stroke(obj, color = ''){
		var b = $('#pg_stroke_width').val();
		var c = color == '' ? $('#pg_stroke_colorPicker').val() : color;
		obj.set({
			stroke: c,
			strokeWidth: parseFloat(b)
		});
	}
	function shadow(obj){
		var x = $('#ed_shadow_offsetX').val();
		var y = $('#ed_shadow_offsetY').val();
		var b = $('#ed_shadow_blur').val();
		var c = $('#ed_shadow_colorPicker').val();
		obj.setShadow({
			color: c,
			blur: b,
			offsetX: x,
			offsetY: y
		});
	}
	function gradient_color(obj, color = '', attr = ''){
		var f = obj;
		var k = color != '' && attr == 'ed_gradient_color_colorPicker_1' ? color : $('#ed_gradient_color_colorPicker_1').val();
		var j = color != '' && attr == 'ed_gradient_color_colorPicker_2' ? color : $('#ed_gradient_color_colorPicker_2').val();
		var angle = $('#ed_gradient_color_angle').val();
		
		var x1 = obj.width / 2, y1 = obj.height / 2, length = obj.width / 2, x2, y2;
		var angle = +angle / 180 * Math.PI,
			x2 = x1 + Math.cos(angle) * length,
			y2 = y1 + Math.sin(angle) * length;
		obj.setGradient("fill", {
			x1: x1,
			y1: y1,
			x2: x2,
			y2: y2,
			colorStops: {
				0: k,
				1: j
			}
		});
		
	}
	function zoomTo(j=1) {
		if (j < 0.2) {
			j = 0.1
		}
		if(j===0.7 || j ===0.65){
          j = 1;
		}
		var f = jQuery(".pg-canvas-wrapper .canvas-container");
		var b = f.width();
		var c = f.height();
		var a = jQuery(".pg-canvas-holder").outerWidth();
		var h = jQuery(".pg-canvas-holder").outerHeight(); 
		var d = a / 2 - (b * j) / 2 + 10;
		var g = h / 2 - (c * j) / 2 + 10;
		DEBUG && console.log("hw: " + a + " h: " + c + " s: " + j);
		f.css({
			transform: "scale(" + j + ")",
			position: "absolute"
		});
		if (a < b * j) {
			d = 10
		}
		if (h < c * j) {
			g = 10
		}
		f.css({
			left: d,
			top: g
		});

		console.log(j);
        
		jQuery(".ed_zoom_value").val(parseInt(j * 100));
		jQuery(".ed_zoom_number").text(parseInt(j * 100)+'%');
	}
	function set_background_pattern( objects, options ){
		canvas.setBackgroundColor({
			id:'ed_pattern',
			source: objects,
			repeat: 'repeat',
		}, canvas.renderAll.bind(canvas));
	}
	function bad_word_checker_fun(test){
		var check = /\b(4r5e|5h1t|5hit|a55|anal|anus|ar5e|arrse|arse|ass|ass-fucker|asses|assfucker|assfukka|asshole|assholes|asswhole|a_s_s|b!tch|b00bs|b17ch|b1tch|ballbag|balls|ballsack|bastard|beastial|beastiality|bellend|bestial|bestiality|bi\+ch|biatch|bitch|bitcher|bitchers|bitches|bitchin|bitching|bloody|blow job|blowjob|blowjobs|boiolas|bollock|bollok|boner|boob|boobs|booobs|boooobs|booooobs|booooooobs|breasts|buceta|bugger|bum|bunny fucker|butt|butthole|buttmuch|buttplug|c0ck|c0cksucker|carpet muncher|cawk|chink|cipa|cl1t|clit|clitoris|clits|cnut|cock|cock-sucker|cockface|cockhead|cockmunch|cockmuncher|cocks|cocksuck|cocksucked|cocksucker|cocksucking|cocksucks|cocksuka|cocksukka|cok|cokmuncher|coksucka|coon|cox|crap|cum|cummer|cumming|cums|cumshot|cunilingus|cunillingus|cunnilingus|cunt|cuntlick|cuntlicker|cuntlicking|cunts|cyalis|cyberfuc|cyberfuck|cyberfucked|cyberfucker|cyberfuckers|cyberfucking|d1ck|damn|dick|dickhead|dildo|dildos|dink|dinks|dirsa|dlck|dog-fucker|doggin|dogging|donkeyribber|doosh|duche|dyke|ejaculate|ejaculated|ejaculates|ejaculating|ejaculatings|ejaculation|ejakulate|f u c k|f u c k e r|f4nny|fag|fagging|faggitt|faggot|faggs|fagot|fagots|fags|fanny|fannyflaps|fannyfucker|fanyy|fatass|fcuk|fcuker|fcuking|feck|fecker|felching|fellate|fellatio|fingerfuck|fingerfucked|fingerfucker|fingerfuckers|fingerfucking|fingerfucks|fistfuck|fistfucked|fistfucker|fistfuckers|fistfucking|fistfuckings|fistfucks|flange|fook|fooker|fuck|fucka|fucked|fucker|fuckers|fuckhead|fuckheads|fuckin|fucking|fuckings|fuckingshitmotherfucker|fuckme|fucks|fuckwhit|fuckwit|fudge packer|fudgepacker|fuk|fuker|fukker|fukkin|fuks|fukwhit|fukwit|fux|fux0r|f_u_c_k|gangbang|gangbanged|gangbangs|gaylord|gaysex|goatse|God|god-dam|god-damned|goddamn|goddamned|hardcoresex|hell|heshe|hoar|hoare|hoer|homo|hore|horniest|horny|hotsex|jack-off|jackoff|jap|jerk-off|jism|jiz|jizm|jizz|kawk|knob|knobead|knobed|knobend|knobhead|knobjocky|knobjokey|kock|kondum|kondums|kum|kummer|kumming|kums|kunilingus|l3i\+ch|l3itch|labia|lust|lusting|m0f0|m0fo|m45terbate|ma5terb8|ma5terbate|masochist|master-bate|masterb8|masterbat*|masterbat3|masterbate|masterbation|masterbations|masturbate|mo-fo|mof0|mofo|mothafuck|mothafucka|mothafuckas|mothafuckaz|mothafucked|mothafucker|mothafuckers|mothafuckin|mothafucking|mothafuckings|mothafucks|mother fucker|motherfuck|motherfucked|motherfucker|motherfuckers|motherfuckin|motherfucking|motherfuckings|motherfuckka|motherfucks|muff|mutha|muthafecker|muthafuckker|muther|mutherfucker|n1gga|n1gger|nazi|nigg3r|nigg4h|nigga|niggah|niggas|niggaz|nigger|niggers|nob|nob jokey|nobhead|nobjocky|nobjokey|numbnuts|nutsack|orgasim|orgasims|orgasm|orgasms|p0rn|pawn|pecker|penis|penisfucker|phonesex|phuck|phuk|phuked|phuking|phukked|phukking|phuks|phuq|pigfucker|pimpis|piss|pissed|pisser|pissers|pisses|pissflaps|pissin|pissing|pissoff|poop|porn|porno|pornography|pornos|prick|pricks|pron|pube|pusse|pussi|pussies|pussy|pussys|rectum|retard|rimjaw|rimming|s hit|s.o.b.|sadist|schlong|screwing|scroat|scrote|scrotum|semen|sex|sh!\+|sh!t|sh1t|shag|shagger|shaggin|shagging|shemale|shi\+|shit|shitdick|shite|shited|shitey|shitfuck|shitfull|shithead|shiting|shitings|shits|shitted|shitter|shitters|shitting|shittings|shitty|skank|slut|sluts|smegma|smut|snatch|son-of-a-bitch|spac|spunk|s_h_i_t|t1tt1e5|t1tties|teets|teez|testical|testicle|tit|titfuck|tits|titt|tittie5|tittiefucker|titties|tittyfuck|tittywank|titwank|tosser|turd|tw4t|twat|twathead|twatty|twunt|twunter|v14gra|v1gra|vagina|viagra|vulva|w00se|wang|wank|wanker|wanky|whoar|whore|willies|willy|xrated|xxx)\b/gi;
		if(bad_word_checker == false){
			bad_word_checker = check.test(test);			
		}

	}
	function getTotal(first,second){
		return first + second;
	}
	function set_background_color(a) {
		$('#pg_canvas_background_picker').val(a);
		$('#pg_canvas_background_picker').next().css({
			'background-color':a
		});
		canvas.setBackgroundColor(a);
		canvas.renderAll()
	}
	function show_background_edit(){
		if(canvas.backgroundImage === null){
			$('.pg-editor-aside-nav > ul > li > a').removeClass('active');
			$('#main_tab_background').addClass('active');
			element_text.hide();
			element_ai_text.hide();
			element_overlay.hide();
			element_shape.hide();
			element_image.hide();
			property_object.find('.pg-property-widget').hide();
			if(typeof canvas.backgroundColor === "object" && canvas.backgroundColor.type == 'linear'){
				$("#pg_canvas_gradient_picker_1").val(canvas.backgroundColor.colorStops[0].color);
				$("#pg_canvas_gradient_picker_2").val(canvas.backgroundColor.colorStops[1].color);
				var deltaX = canvas.backgroundColor.coords.x2 - canvas.backgroundColor.coords.x1;
				var deltaY = canvas.backgroundColor.coords.y2 - canvas.backgroundColor.coords.y1;
				var rad = Math.atan2(deltaY, deltaX) * (180 / Math.PI);
				if(rad < 0){
					rad = 360 + rad;
				}
				$("#pg_canvas_gradient_angle").prev().children().val(rad);
				$("#pg_canvas_gradient_angle").val(rad).change();
				$("#pg_canvas_gradient_picker_1").change();
				$("#pg_canvas_gradient_picker_2").change();
			}else if(typeof canvas.backgroundColor === "object" && canvas.backgroundColor.type == 'radial'){
				$("#pg_canvas_gradient_picker_1").val(canvas.backgroundColor.colorStops[0].color);
				$("#pg_canvas_gradient_picker_2").val(canvas.backgroundColor.colorStops[1].color);	
				$("#pg_canvas_gradient_radius").prev().children().val(canvas.backgroundColor.coords.r1 * 4);
				$('#pg_canvas_gradient_radius').val(canvas.backgroundColor.coords.r1 * 4);
				$('#radial_gradient').trigger('click');
				$("#pg_canvas_gradient_picker_1").change();
				$("#pg_canvas_gradient_picker_2").change();
			}else if(typeof canvas.backgroundColor === "object" && canvas.backgroundColor.type == 'pattern'){
				var pa_srcc = canvas.backgroundColor.source.src;
				if(pa_srcc.indexOf("data:image/svg+xml;charset=utf-8,") >= 0){
					var data = pa_srcc.replace('data:image/svg+xml;charset=utf-8,','');
					$('.ed_pattern_svg').html(data);
					var color = '', html = '';
					var path = fabric.loadSVGFromString(data,function(objects, options) {
						for(var i=0;i<objects.length;i++){
							color = objects[i].fill;
							html = '<div class="pg-colorPicker-container" data-index="'+i+'">';
								html += '<input type="text" class="pg_colorPicker input-group-addon" value="'+color+'" /><span class="color_viewer 2" style="background-color: '+color+';"></span>';
							html += '</div>';
							$('.ed_pattern_colorpicker').append(html);
						}
						bootstrap_colorpicker_js('pattern');
					});
				}else{
					$('.ed_bg_pattern').each(function(){
						if($(this).data('pattern') == pa_srcc){
							$(this).click();
							return false;
						}
					});
				} 
			}else{
				$('#pg_canvas_background_picker').val(canvas.backgroundColor);
				$('#pg_canvas_background_picker').next().css({
					'background-color':canvas.backgroundColor
				}); 
				$('#pg_canvas_background_picker').parent().css("color", canvas.backgroundColor);
			}			
			property_object.show();
			element_background.show();
			return false;
		}
		if (typeof canvas.backgroundImage !== "undefined" && (canvas.backgroundImage.type === "undefined" || canvas.backgroundImage.type !== "image")) {
				
		} else {
			var d = canvas.backgroundImage.opacity;
			jQuery("#ed_object_opacity").val(d ? (d * 100 + '%') : 100);
			$('.pg_range_slider input#txt_opacity').val(d ? (d * 100) : 100).change();
			var a = canvas.backgroundImage._element.src;
			edit_bg_crop_image(a);
		}
	}
	function set_object_pos() {
		var a = canvas.getActiveObject() || canvas.getActiveGroup();
		
		if (a.originX == "center") {
			jQuery("#ed_object_x_position").val(parseInt(a.left - a.width / 2));
			jQuery("#ed_object_y_position").val(parseInt(a.top - a.height / 2));
		} else {
			jQuery("#ed_object_x_position").val(parseInt(a.left));
			jQuery("#ed_object_y_position").val(parseInt(a.top))
		}
	}
	function show_text_panel(d){
		$('.pg-editor-aside-nav > ul > li > a').removeClass('active');
		$('#main_tab_text').addClass('active');
		property_object.find('.pg-property-widget').hide();
		element_text.hide();
		element_ai_text.hide();
		element_overlay.hide(); 
		element_shape.hide();
		element_background.hide();
		property_object.show();
		property_object.find('.pg-property-widget.edp_text').show();
		property_object.find('.pg-property-widget.edp_pos').show();
		property_object.find('.pg-property-widget.edp_opacity').show();

		//property_object.find('.pg-property-widget.edp_color').show(); 

		property_object.find('.pg-property-widget.edp_layer_option').show();
		property_object.find('.pg-property-widget.edp_shadow').show();
		property_object.find('.pg-property-widget.edp_stroke').show();
		property_object.find('.pg-property-widget.edp_gradient_color').show();
		jQuery(".ed_text_align").removeClass('active');
		jQuery(".ed_text_decoration").removeClass('active');
		if(typeof d.fill != 'object' && d.fill){
			ed_remove_colorpicker();
			ed_show_colorpicker(null, d.fill);
			property_object.find('.pg-property-widget.edp_color').show();
			bootstrap_colorpicker_js();
		}else{
			ed_remove_colorpicker();
			ed_show_colorpicker(null, '#d1d1d1');
			property_object.find('.pg-property-widget.edp_color').show();
			bootstrap_colorpicker_js();
		}
		jQuery("#ed_font_size").val(d.fontSize);
		$('#pg_canvas_textarea').val(d.text);
		jQuery("#ed_object_rotation_angle").val(d.angle ? d.angle : 0);
		jQuery("#ed_object_x_position").val(d.left);
		jQuery("#ed_object_y_position").val(d.top);
		jQuery("#ed_object_opacity").val(d.opacity ? (d.opacity * 100 + '%') : 100);
		$('.pg_range_slider input#txt_opacity').val(d.opacity ? (d.opacity * 100) : 100).change();
		jQuery("#ed_font_linehight").val(d.lineHeight);
		if(d.textAlign == 'left'){
			jQuery(".ed_text_align.txt_alignleft").addClass('active');
		}
		if(d.textAlign == 'center'){
			jQuery(".ed_text_align.txt_aligncenter").addClass('active');
		}
		if(d.textAlign == 'right'){
			jQuery(".ed_text_align.txt_alignright").addClass('active');
		}
		if(d.textDecoration == 'underlined'){
			jQuery(".ed_text_decoration.txt_underlined").addClass('active');
		}
		if(d.textDecoration == 'line-through'){
			jQuery(".ed_text_decoration.txt_linethrough").addClass('active');
		}
		if(d.textDecoration == 'overline'){
			jQuery(".ed_text_decoration.txt_overline").addClass('active');
		}
		if(d.fontWeight == 'bold'){
			jQuery(".ed_fontweight").addClass('active');
		}
		if(d.fontStyle == 'italic'){
			jQuery(".ed_fontstyle").addClass('active');
		}
		ed_common_feature(d);
	}
	function ed_show_colorpicker(i, color){
	    var html = '<div class="pg-colorPicker-container" data-index="'+i+'">';
			html += '<input type="text" class="pg_colorPicker input-group-addon" value="'+color+'" /><span class="color_viewers 3" style="background-color: '+color+';"></span>';
		html += '</div>';
		property_object.find('.pg-property-widget.edp_color').append(html);
    }
	function bootstrap_colorpicker_js( where = null ){

		if(where == null){
            /**
			 * Coloris
			 */
			Coloris({
				el: '.pg_colorPicker',
				swatches: [
				'#264653',
				'#2a9d8f',
				'#e9c46a',
				'#f4a261',
				'#e76f51',
				'#d62828',
				'#023e8a',
				'#0077b6',
				'#0096c7',
				'#00b4d8',
				'#48cae4'
				]
			}); 

			$('.pg_colorPicker').on("change",function(e) {
				var color =  $(this).val();		
			
				var index = $(this).parents('.pg-colorPicker-container').data('index');
				if(index == 'return') return;
			
				$(this).next().css({
					'background-color':color
				});
				if(index != null && canvas.getActiveObject().paths.length){
					var obj = canvas.getActiveObject().paths[index];
					obj.set({
						fill : color
					});
				}else{
					var obj = canvas.getActiveObject();
					obj.set({
						fill : color
					});
				}
				canvas.renderAll();

			})

            let color_arr = [''];
			$('#clr-color-marker').mouseup(function(e) {
				console.log('Ajay Hello3');
				// var color = $('.pg_colorPicker').val(); //e.color.toString('rgba');	
				// var color_old = localStorage.getItem("savecolorcode");
				// var index = $(this).parent().data('index');
				// if(index == 'return') return;
				// $(this).next().css({
				// 	'background-color':color
				// }); 
				// console.log(canvas.getActiveObject().paths.length ,"")
				// if( canvas.getActiveObject().paths.length){
				// 	// var obj = canvas.getActiveObject();
				// 	var obj1 = canvas.getActiveObject().paths;
				// 	let d2= '';
				// 	if(color_old){
				// 	    d2=obj1.filter(d1=>d1.fill == color_old)
				// 	}else{
				// 		d2=obj1.filter(d1=>d1.fill == color)
				// 	}
					
					
				// 	if(d2.length>0)
				// 	{
				// 		for(let i=0; i<d2.length;i++)
				// 		{
				// 			d2[i].set({
				// 				fill : color
				// 			});
				// 			localStorage.setItem("savecolorcode_"+i, color);
				// 		}
				// 	}
				// }else{
				// 	var obj = canvas.getActiveObject();
				// 	console.log(obj);
				// 	obj.set({
				// 		fill : color
				// 	});
				// }
				
				
				// // canvas.renderAll();
				// var color = $('.pg_colorPicker').val(); 			
				// var index =$(this).parents('.pg-colorPicker-container').data('index');
				// if(index == 'return') return;
				
				// $(this).next().css({
				// 	'background-color':color
				// }); 	
				// if(index != null && canvas.getActiveObject().paths.length){
				// 	var obj = canvas.getActiveObject().paths[index];
				// 	obj.set({
				// 		fill : color
				// 	});
				// }else{
				// 	var obj = canvas.getActiveObject();
				// 	obj.set({
				// 		fill : color
				// 	});
				// }
				// canvas.renderAll();
			})

			 
		}else if(where == 'pattern'){
			/**
			 * Coloris
			 */
			Coloris({
				el: '.pg_colorPicker',
				swatches: [
				'#264653',
				'#2a9d8f',
				'#e9c46a',
				'#f4a261',
				'#e76f51',
				'#d62828',
				'#023e8a',
				'#0077b6',
				'#0096c7',
				'#00b4d8',
				'#48cae4'
				]
			});
			
			// $('.pg_colorPicker').colorpicker({
			// 	customClass: 'colorpicker-2x',
			// 	align: 'left',
			// 	sliders: {
			// 		saturation: {
			// 			maxLeft: 200,
			// 			maxTop: 200
			// 		},
			// 		hue: {
			// 			maxTop: 200
			// 		},
			// 		alpha: {
			// 			maxTop: 200
			// 		}
			// 	}
			// });
			
			// $('.pg_colorPicker').colorpicker().on('change', function(e) {
			// 	var color = e.color.toString('rgba');
			// 	var index = $(this).parent().data('index');
			// 	$(this).next().css({
			// 		'background-color':color
			// 	});
			// 	$('.ed_pattern_svg svg path').eq(index).attr('fill', color);
			// 	var data = $('.ed_pattern_svg').html();
			// 	var img = "data:image/svg+xml;charset=utf-8,"+data;
			// 	set_background_pattern( img, '' );			
			// }); 

			$('.pg_colorPicker').on('change', function(e) {
				
				var color = $(this).val(); //e.color.toString('rgba');
				var index = $(this).parent().data('index');
				$(this).next().css({
					'background-color':color
				});
				$('.ed_pattern_svg svg path').eq(index).attr('fill', color);
				var data = $('.ed_pattern_svg').html();
				var img = "data:image/svg+xml;charset=utf-8,"+data;
				set_background_pattern( img, '' );			
			});
		}
	} 
	function ed_remove_colorpicker(){
		//property_object.find('.pg-property-widget.edp_color .pg-colorPicker-container .pg_colorPicker').colorpicker('destroy');
		property_object.find('.pg-property-widget.edp_color .pg-colorPicker-container').remove();
	}
	function ed_show_svg_text( index, d ){
		var html = '<h3 class="pg-sidebar-heading">Enter text</h3>';
		html += '<div class="pg-property-body">';
			html += '<div class="pg-sidebar-input">';
				html += '<textarea rows="3" class="form-control pg_canvas_svg_textarea" data-index="'+index+'">'+d.text+'</textarea>';
			html += '</div>';
		html += '</div>';
		
		html += '<h3 class="pg-sidebar-heading">Text Options</h3>';
		html += '<div class="pg-property-body">';
			html += '<div class="row">';
				html += '<div class="col-xs-12">';
					html += '<div class="pg-sidebar-input">';
						html += '<label>Font Family</label>';
						html += '<div class="pg-select-type" data-index="'+index+'">';
							html += '<select class="form-control pg_canvas_svg_fontfamily">';
                                html += '<option data-content="<div style=\'font-family: Abril Fatface;\'>Abril Fatface</div>" value="Abril Fatface">Abril Fatface</option>';
								html += '<option data-content="<div style=\'font-family: Anton;\'>Anton</div>" value="Anton">Anton</option>';
                                html += '<option data-content="<div style=\'font-family: Dancing Script;\'>Dancing Script</div>" value="Dancing Script">Dancing Script</option>';
								html += '<option data-content="<div style=\'font-family: Droid Sans;\'>Droid Sans</div>" value="Droid Sans">Droid Sans</option>';
								html += '<option data-content="<div style=\'font-family: Droid Serif;\'>Droid Serif</div>" value="Droid Serif">Droid Serif</option>';
								html += '<option data-content="<div style=\'font-family: Gloria Hallelujah;\'>Gloria Hallelujah</div>" value="Gloria Hallelujah">Gloria Hallelujah</option>';
								html += '<option data-content="<div style=\'font-family: Indie Flower;\'>Indie Flower</div>" value="Indie Flower">Indie Flower</option>';
								html += '<option data-content="<div style=\'font-family: Lato;\'>Lato</div>" value="lato">Lato</option>';
								html += '<option data-content="<div style=\'font-family: Lobster;\'>Lobster</div>" value="Lobster">Lobster</option>';
								html += '<option data-content="<div style=\'font-family: Lora;\'>Lora</div>" value="Lora">Lora</option>';
								html += '<option data-content="<div style=\'font-family: Montserrat;\'>Montserrat</div>" value="Montserrat">Montserrat</option>';
								html += '<option data-content="<div style=\'font-family: Open Sans;\'>Open Sans</div>" value="Open Sans">Open Sans</option>';
								html += '<option data-content="<div style=\'font-family: Oswald;\'>Oswald</div>" value="Oswald">Oswald</option>';
								html += '<option data-content="<div style=\'font-family: PT Sans;\'>PT Sans</div>" value="PT Sans">PT Sans</option>';
								html += '<option data-content="<div style=\'font-family: PT Serif;\'>PT Serif</div>" value="PT Serif">PT Serif</option>';
								html += '<option data-content="<div style=\'font-family: Pacifico;\'>Pacifico</div>" value="Pacifico">Pacifico</option>';
								html += '<option data-content="<div style=\'font-family: Playfair Display;\'>Playfair Display</div>" value="Playfair Display">Playfair Display</option>';
								html += '<option data-content="<div style=\'font-family: Raleway;\'>Raleway</div>" value="Raleway">Raleway</option>';
								html += '<option data-content="<div style=\'font-family: Roboto;\'>Roboto</div>" value="roboto">Roboto</option>';
								html += '<option data-content="<div style=\'font-family: Roboto Condensed;\'>Roboto Condensed</div>" value="Roboto Condensed">Roboto Condensed</option>';
								html += '<option data-content="<div style=\'font-family: Roboto Slab;\'>Roboto Slab</div>" value="Roboto Slab">Roboto Slab</option>';
								html += '<option data-content="<div style=\'font-family: Rubik;\'>Rubik</div>" value="Rubik">Rubik</option>';
								html += '<option data-content="<div style=\'font-family: Slabo 27px;\'>Slabo 27px</div>" value="Slabo 27px">Slabo 27px</option>';
								html += '<option data-content="<div style=\'font-family: Source Sans Pro;\'>Source Sans Pro</div>" value="Source Sans Pro">Source Sans Pro</option>';
                                html += '<option data-content="<div style=\'font-family: Ubuntu;\'>Ubuntu</div>" value="Ubuntu">Ubuntu</option>';
                                html += '<option data-content="<div style=\'font-family: Monoton;\'>Monoton</div>" value="Monoton">Monoton</option>';
                                html += '<option data-content="<div style=\'font-family: Bungee Inline;\'>Bungee Inline</div>" value="Bungee Inline">Bungee Inline</option>';
                                html += '<option data-content="<div style=\'font-family: Black Ops One;\'>Black Ops One</div>" value="Black Ops One">Black Ops One</option>';
                                html += '<option data-content="<div style=\'font-family: Finger Paint;\'>Finger Paint</div>" value="Finger Paint">Finger Paint</option>';
                                html += '<option data-content="<div style=\'font-family: Bungee Shade;\'>Bungee Shade</div>" value="Bungee Shade">Bungee Shade</option>';
                                html += '<option data-content="<div style=\'font-family: Ribeye Marrow;\'>Ribeye Marrow</div>" value="Ribeye Marrow">Ribeye Marrow</option>';
                                html += '<option data-content="<div style=\'font-family: Suez One;\'>Suez One</div>" value="Suez One">Suez One</option>';
                                html += '<option data-content="<div style=\'font-family: Teko;\'>Teko</div>" value="Teko">Teko</option>';
                                html += '<option data-content="<div style=\'font-family: Josefin Sans;\'>Josefin Sans</div>" value="Josefin Sans">Josefin Sans</option>';
                                html += '<option data-content="<div style=\'font-family: Acme;\'>Acme</div>" value="Acme">Acme</option>';
                                html += '<option data-content="<div style=\'font-family: Varela Round;\'>Varela Round</div>" value="Varela Round">Varela Round</option>';
                                html += '<option data-content="<div style=\'font-family: Archivo Black;\'>Archivo Black</div>" value="Archivo Black">Archivo Black</option>';
                                html += '<option data-content="<div style=\'font-family: Berkshire Swash;\'>Berkshire Swash</div>" value="Berkshire Swash">Berkshire Swash</option>';
                                html += '<option data-content="<div style=\'font-family: Righteous;\'>Righteous</div>" value="Righteous">Righteous</option>';
                                html += '<option data-content="<div style=\'font-family: Concert One;\'>Concert One</div>" value="Concert One">Concert One</option>';
                                html += '<option data-content="<div style=\'font-family: Fredoka One;\'>Fredoka One</div>" value="Fredoka One">Fredoka One</option>';
                                html += '<option data-content="<div style=\'font-family: Limelight;\'>Limelight</div>" value="Limelight">Limelight</option>';
                                html += '<option data-content="<div style=\'font-family: Cabin Sketch;\'>Cabin Sketch</div>" value="Cabin Sketch">Cabin Sketch</option>';
                                html += '<option data-content="<div style=\'font-family: Electrolize;\'>Electrolize</div>" value="Electrolize">Electrolize</option>';
                                html += '<option data-content="<div style=\'font-family: Niconne;\'>Niconne</div>" value="Niconne">Niconne</option>';
                                html += '<option data-content="<div style=\'font-family: Aclonica;\'>Aclonica</div>" value="Aclonica">Aclonica</option>';
                                html += '<option data-content="<div style=\'font-family: Reem Kufi;\'>Reem Kufi</div>" value="Reem Kufi">Reem Kufi</option>';
                                html += '<option data-content="<div style=\'font-family: Love Ya Like A Sister;\'>Love Ya Like A Sister</div>" value="Love Ya Like A Sister">Love Ya Like A Sister</option>';
                                html += '<option data-content="<div style=\'font-family: Vast Shadow;\'>Vast Shadow</div>" value="Vast Shadow">Vast Shadow</option>';
                                html += '<option data-content="<div style=\'font-family: Ravi Prakash;\'>Ravi Prakash</div>" value="Ravi Prakash">Ravi Prakash</option>';
                                html += '<option data-content="<div style=\'font-family: Germania One;\'>Germania One</div>" value="Germania One">Germania One</option>';
                                html += '<option data-content="<div style=\'font-family: Nosifer;\'>Nosifer</div>" value="Nosifer">Nosifer</option>';
                                html += '<option data-content="<div style=\'font-family: Pirata One;\'>Pirata One</div>" value="Pirata One">Pirata One</option>';
                                html += '<option data-content="<div style=\'font-family: Rubik Mono One;\'>Rubik Mono One</div>" value="Rubik Mono One">Rubik Mono One</option>';
                                html += '<option data-content="<div style=\'font-family: Butcherman;\'>Butcherman</div>" value="Butcherman">Butcherman</option>';
                                html += '<option data-content="<div style=\'font-family: Great Vibes;\'>Great Vibes</div>" value="Great Vibes">Great Vibes</option>';
                            html += '</select>';
						html += '</div>';
					html += '</div>';
				html += '</div>';
				html += '<div class="col-xs-6">';
					html += '<div class="pg-sidebar-input" data-index="'+index+'">';
						html += '<label>Size</label>';
						html += '<input type="number" class="form-control ed_svg_font_size" value="'+d.fontSize+'">';
					html += '</div>';
				html += '</div>';
				html += '<div class="col-xs-6">';
					html += '<div class="pg-sidebar-input" data-index="'+index+'">';
						html += '<label>Line height</label>';
						html += '<input type="number" class="form-control ed_svg_font_linehight" value="'+d.lineHeight+'">';
					html += '</div>';
				html += '</div>';
			html += '</div>';
			html += '<div class="pg-sidebar-input">';
				html += '<div class="pg-editor-text-option">';
					html += '<ul data-index="'+index+'">';
						html += '<li><a title="Bold" class="txt_bold ed_svg_fontweight '+(d.fontWeight == 'bold' ? 'active' : '')+'"><img src="'+ajaxurl+'assets/images/icon/editor/bold.svg" alt=""></a></li>';
						html += '<li><a title="Italic" class="txt_italic ed_svg_fontstyle '+(d.fontStyle == 'italic' ? 'active' : '')+'"><img src="'+ajaxurl+'assets/images/icon/editor/italic.svg" alt=""></a></li>';
						html += '<li><a title="Underlined" class="txt_underlined ed_svg_text_decoration '+(d.textDecoration == 'underlined' ? 'active' : '')+'"><img src="'+ajaxurl+'assets/images/icon/editor/underlined.svg" alt=""></a></li>';
						html += '<li><a title="Line through" class="txt_linethrough ed_svg_text_decoration '+(d.textDecoration == 'line-through' ? 'active' : '')+'"><img src="'+ajaxurl+'assets/images/icon/editor/line-through.svg" alt=""></a></li>';
						html += '<li><a title="Overline" class="txt_overline ed_svg_text_decoration '+(d.textDecoration == 'overline' ? 'active' : '')+'"><img src="'+ajaxurl+'assets/images/icon/editor/overline.svg" alt=""></a></li>';
						html += '<li><a title="Align left" class="txt_alignleft ed_svg_text_align '+(d.textAlign == 'left' ? 'active' : '')+'"><img src="'+ajaxurl+'assets/images/icon/editor/align-left.svg" alt=""></a></li>';
						html += '<li><a title="Align center" class="txt_aligncenter ed_svg_text_align '+(d.textAlign == 'center' ? 'active' : '')+'"><img src="'+ajaxurl+'assets/images/icon/editor/align-center.svg" alt=""></a></li>';
						html += '<li><a title="Align right" class="txt_alignright ed_svg_text_align '+(d.textAlign == 'right' ? 'active' : '')+'"><img src="'+ajaxurl+'assets/images/icon/editor/align-right.svg" alt=""></a></li>';
					html += '</ul>';
				html += '</div>';
			html += '</div>';
		html += '</div>';
		property_object.find('.pg-property-widget.edp_svg_text_opt').append(html);
		property_object.find('.pg-property-widget.edp_svg_text_opt').show();
	}
	function ed_hide_svg_text(){
		property_object.find('.pg-property-widget.edp_svg_text_opt').html('');
		property_object.find('.pg-property-widget.edp_svg_text_opt').hide();
	}
	function show_shape_edit_panel(d,overley=false) {
		
		var color = false, text = false;
		property_object.find('.pg-property-widget').hide();
		element_background.hide();
		ed_remove_colorpicker();

		console.log(d.paths);
        let color_arr = [];
		if(d.paths){
			for(var i = 0; i < d.paths.length; i++){
				if(d.paths[i].fill){
					color = true;
					ed_show_colorpicker(i, d.paths[i].fill);
					color_arr.push(d.paths[i].fill)
					localStorage.setItem("savecolorcode",color_arr);
				}
				if(d.paths[i].text){
					ed_show_svg_text(i, d.paths[i]);
				}
			} 
		}else if(overley===true){
			ed_show_colorpicker(1,'#000');
		    color = true;
		}
		
		element_text.hide();
		element_ai_text.hide();
		element_overlay.hide();
		element_shape.hide();
		property_object.show();
	
		if(color === true){
			property_object.find('.pg-property-widget.edp_color').show();
			bootstrap_colorpicker_js();
		}
		property_object.find('.pg-property-widget.edp_pos').show();
		property_object.find('.pg-property-widget.edp_opacity').show();
		//property_object.find('.pg-property-widget.edp_color').show(); 
		property_object.find('.pg-property-widget.edp_layer_option').show();
		property_object.find('.pg-property-widget.edp_shadow').show();
		jQuery("#ed_object_rotation_angle").val(d.angle ? d.angle : 0);
		jQuery("#ed_object_x_position").val(d.left);
		jQuery("#ed_object_y_position").val(d.top);
		jQuery("#ed_object_opacity").val(d.opacity ? (d.opacity * 100 + '%') : 100);
		$('.pg_range_slider input#txt_opacity').val(d.opacity ? (d.opacity * 100) : 100).change();
		ed_common_feature(d);
	}
	function set_background_gradient() {
		var k = $("#pg_canvas_gradient_picker_1").val();
		var j = $("#pg_canvas_gradient_picker_2").val();
		var angle = $("#pg_canvas_gradient_angle").val();
		var x1 = canvas.width / 2, y1 = canvas.height / 2, length = canvas.width / 2, x2, y2;
		if($('#linear_gradient').is(':checked')){
			var angle = +angle / 180 * Math.PI,
				x2 = x1 + Math.cos(angle) * length,
				y2 = y1 + Math.sin(angle) * length;
			var gradient = new fabric.Gradient({
				type:'linear',
				coords:{
					x1:x1, y1:y1, x2:x2, y2:y2
				},
				colorStops:[ { color: k, offset: 0, }, { color: j, offset: 1, } ]
			});
			canvas.setBackgroundColor(gradient).renderAll();
		}else if($('#radial_gradient').is(':checked')){
			var ctx = canvas.getContext("2d"),
			innerRadius = ($('#pg_canvas_gradient_radius').val() / 2) / 2,
			outerRadius = canvas.width / 2,
			radius = canvas.width;
			var gradient = new fabric.Gradient({
				type:'radial',
				coords:{
					x1:x1, y1:y1, x2:x1, y2:y1, r1:innerRadius, r2:outerRadius
				},
				colorStops:[ { color: k, offset: 0, }, { color: j, offset: 1, } ]
			});
			canvas.setBackgroundColor(gradient).renderAll();
		}
	}
	function load_svg_from_string(b) {
		
		var path = fabric.loadSVGFromString(b,function(objects, options) {
			var obj = fabric.util.groupSVGElements(objects, options);
		    obj.set({
				left: canvas.width / 2,
				top: canvas.height / 2,
				originX: "center",
				originY: "center",
				width: options.width,
				height: options.height
			});
			obj.center().setCoords();
			if (obj.width > canvas.width) {
				obj.scaleToWidth(canvas.width)
			}
			if (obj.height > canvas.height) {
				obj.scaleToHeight(canvas.height)
			}
			canvas.add(obj).renderAll();
		});
	}
	function zoomIt(j, l) {
		l.setHeight(l.getHeight() * j);
		l.setWidth(l.getWidth() * j);
		var p = l.getObjects();
		for (var f in p) {
			var n = p[f].scaleX;
			var m = p[f].scaleY;
			var b = p[f].left;
			var k = p[f].top;
			var h = n * j;
			var g = m * j;
			var c = b * j;
			var a = k * j;
			p[f].scaleX = h;
			p[f].scaleY = g;
			p[f].left = c;
			p[f].top = a;
			p[f].setCoords()
		}
		if (l.backgroundImage) {
			var d = l.backgroundImage;
			var d = l.backgroundImage;
			var n = d.scaleX;
			var m = d.scaleY;
			var b = d.left;
			var k = d.top;
			var h = n * j;
			var g = m * j;
			var c = b * j;
			var a = k * j;
			d.scaleX = h;
			d.scaleY = g;
			d.left = c;
			d.top = a;
			d.setCoords();
			l.setBackgroundImage(d, l.renderAll.bind(l))
		}
	}
	
	function set_canvas_size(b, a) {
		var b = parseInt(b);
		var a = parseInt(a);
		
		if (b > 0 && a > 0) {
			canvas.setWidth(b);
			canvas.setHeight(a);
			canvas.renderAll();
			set_canvas_pos();
			if (canvas.backgroundImage) {
				set_canvas_bg(canvas.backgroundImage._element.src)
			}
			
		}
	}
	function set_canvas_pos() {
		if (Modernizr.touch) {
			var d = 50
		} else {
			var d = parseInt(jQuery(".pg-canvas-wrapper .pg-canvas-holder").css("padding-top").replace("px", ""))
		}
		var k = parseInt(jQuery("#scale-value input").val()) / 100;
		var a = jQuery(".pg-canvas-wrapper .canvas-container");
		var b = a.width();
		var g = a.height();
		var h = jQuery(".pg-canvas-holder").outerWidth();
		var l = jQuery(".pg-canvas-holder").outerHeight();
		var c = h / 2 - (b * k) / 2 + 10;
		var f = l / 2 - (g * k) / 2 + 10;
		a.css({
			position: "absolute"
		});
		DEBUG && console.log("holder width: " + h + " canvas width: " + b + " scale value: " + k);
		if (h < b * k) {
			c = 10
		}
		if (l < g * k) {
			f = 10
		}
		a.css({
			left: c,
			top: f
		});
		
		canvas.calcOffset()
        
	}
	function show_img_edit_panel(d) {
		$('.pg-editor-aside-nav > ul > li > a').removeClass('active');
		$('#main_tab_upload').addClass('active');
		element_text.hide();
		element_ai_text.hide();
		element_overlay.hide();
		element_shape.hide();
		element_background.hide();
		element_image.hide();
		property_object.show();
		property_object.find('.pg-property-widget').hide();
		property_object.find('.pg-property-widget.ed_image_croper').show();
		property_object.find('.pg-property-widget.edp_pos').show();
		property_object.find('.pg-property-widget.edp_opacity').show();
		property_object.find('.pg-property-widget.ed_clip_image').show();
		property_object.find('.pg-property-widget.edp_layer_option').show();
		property_object.find('.pg-property-widget.edp_shadow').show();
		property_object.find('.pg-property-widget.edp_stroke').show();
		if (canvas.getActiveObject().orig_src) {
			var b = canvas.getActiveObject().orig_src;
			var c = parseInt(crop_img_canvas.width) / parseInt(canvas.getActiveObject().width)
		} else {
			var a = canvas.getActiveObject().toObject();
			var b = a.src;
			var c = parseInt(crop_img_canvas.width) / parseInt(canvas.getActiveObject().width);
			var f = a.height
		}
		fabric.util.loadImage(b, function(k) {
			var g = new fabric.Image(k);
			var j = parseInt(crop_img_canvas.width) / parseInt(g.width);
			g.scale(j);
			crop_img_canvas.clear();
			crop_img_canvas.setHeight(g.height * j);
			g.selectable = false;
			g.hasCorners = 0;
			crop_img_canvas.add(g);
			var h = new fabric.Rect();
			crop_img_canvas.add(h);
			if (typeof canvas.getActiveObject().clip_width !== "undefined") {
				crop_img_canvas.item(1).set({
					left: canvas.getActiveObject().clip_left * j,
					top: canvas.getActiveObject().clip_top * j,
					opacity: 0,
					hasRotatingPoint: 0,
					scaleX: 1,
					scaleY: 1
				}).setWidth(canvas.getActiveObject().clip_width * j).setHeight(canvas.getActiveObject().clip_height * j)
			} else {
				var w = crop_img_canvas.getWidth();
				var he = crop_img_canvas.getHeight();
				crop_img_canvas.item(1).set({
					left: 0,
					top: 0,
					opacity: 0,
					hasRotatingPoint: 0,
					scaleX: 1,
					scaleY: 1
				}).setWidth(w).setHeight(he);
			}
			crop_img_canvas.item(1).cornerSize = crop_img_corners_size;
			crop_img_canvas.item(1).lockUniScaling = 1;
			crop_img_canvas.item(1).borderColor = "red";
			crop_img_canvas.item(1).cornerColor = "red";
			crop_img_canvas.item(1).setCoords();
			crop_img_canvas.setActiveObject(crop_img_canvas.item(1));
			crop_img_canvas.renderAll()
		});
		ed_common_feature(d);
	}
	function upload_image( data, type ){
		var form_data = new FormData();
		form_data.append("mediafile", data);
		var xhr = $.ajax({
			url: ajaxurl + 'editor/upload_media', 
			type: "POST",         
			data: form_data, 
			contentType: false,       
			cache: false,            
			processData:false,
			xhr: function(){
				//upload Progress
				var xhr = $.ajaxSettings.xhr();
				if (xhr.upload) {
					xhr.upload.addEventListener('progress', function(event) {
						
						if (event.lengthComputable) {
							
						}else {
							console.log("Failed to compute file upload length");
						}
					}, true);
				}
				return xhr;
			},
			success: function(data){
				var result = jQuery.parseJSON(data);
				if(result.success){
					if(type == 'bg'){
						edit_bg_crop_image(result.image_url);
						set_canvas_bg(result.image_url);
					}else if(type == 'image'){
						canvas_add_image(result.image_url, 0, 0);
					}
					$('.pg-image-list.pg-recent-uploaded.bg').parent().removeClass('hide');
					$('.pg-image-list.pg-recent-uploaded.bg').prepend('<div class="pg-imglist-item"><div class="ed_image pg_canvas_bg_image" data-url="'+result.image_url+'"><img src="'+result.thumb_url+'" alt=""></div><span class="pg-remove-image pg_canvas_bg_remove_image" data-id="'+result.id+'"></span></div>');
					$('.pg-image-list.pg-recent-uploaded.image').parent().removeClass('hide');
					$('.pg-image-list.pg-recent-uploaded.image').prepend('<div class="pg-imglist-item"><div class="ed_image pg_canvas_add_image" data-url="'+result.image_url+'"><img src="'+result.thumb_url+'" alt=""></div><span class="pg-remove-image pg_canvas_add_remove_image" data-id="'+result.id+'"></span></div>');
				}else{
					$.toaster('Image size you added is greater than allowed uppload size. Allowed size is of 8 mb','Error');
				}
			}
		});
	} 
	function canvas_add_image(b, a, g) {
		var j = new Image();
		j.src = b;
		j.onload = function() {
			var p = new fabric.Image(j);
			var m = j.width;
			var l = canvas.width;
			var n = 1;
			if (j.width > canvas.width || j.height > canvas.height) {
				j.width > j.height ? m = j.width : m = j.height;
				canvas.width > canvas.height ? l = canvas.width : l = canvas.height;
				n = l / m / 2
			}
			p.scale(n);
			p.orig_src = j.src;
			canvas.centerObject(p);
			canvas.add(p);
			canvas.renderAll();
			$('.pg_canvas_preloader').addClass('hide');
		}
	}
	function set_canvas_bg(a) {
		fabric.Image.fromURL(a, function(b) {
			b.set({
				originX: "left",
				originY: "top"
			});
			var c = parseInt(canvas.width) / parseInt(b.getWidth());
			b.scale(c);
			if (canvas.getHeight() > b.getHeight()) {
				b.scaleToHeight(canvas.getHeight())
			}
			b.left = (canvas.getWidth() - b.getWidth()) / 2;
			b.top = (canvas.getHeight() - b.getHeight()) / 2;
			canvas.setBackgroundImage(b, canvas.renderAll.bind(canvas));
			$('.pg_canvas_preloader').addClass('hide');
		})
	}
	function edit_bg_crop_image(url){
		$('.pg-editor-aside-nav > ul > li > a').removeClass('active');
		$('#main_tab_background').addClass('active');
		element_text.hide();
		element_ai_text.hide();
		element_shape.hide();
		element_image.hide();
		element_background.hide();
		property_object.show();
		property_object.find('.pg-property-widget').hide();
		property_object.find('.pg-property-widget.ed_background_croper').show();
		property_object.find('.pg-property-widget.edp_opacity').show();
		property_object.find('.pg-property-widget.edp_bg_delete').show();
		fabric.Image.fromURL(url, function(g) {
			var c = g;
			var f = parseInt(crop_bg_canvas.width) / parseInt(c.getWidth());
			c.scale(f);
			crop_bg_canvas.clear();
			crop_bg_canvas.setHeight(parseInt(c.getHeight()));
			c.selectable = false;
			c.hasCorners = 0;
			crop_bg_canvas.add(c);
			crop_bg_canvas.item(0).scaleToWidth( parseInt( crop_bg_canvas.getWidth() ) );
			crop_bg_canvas.item(0).scaleToHeight( parseInt( crop_bg_canvas.getHeight() ) );
			crop_bg_canvas.item(0).centerV();
			crop_bg_canvas.item(0).centerH();
			var d = new fabric.Rect();
			crop_bg_canvas.add(d);
			f = parseInt( crop_bg_canvas.getWidth() ) / parseInt( canvas.getWidth() );
			crop_bg_canvas.item(1).set({
				left: 0,
				top: 0,
				width: parseInt( canvas.getWidth() ),
				height: parseInt( canvas.getHeight() ),
				fill: 0,
				opacity: 0,
				hasRotatingPoint: 0,
				scaleX: 1,
				scaleY: 1
			});
			crop_bg_canvas.item(1).scale(f);
			if ( parseInt( crop_bg_canvas.item(1).getWidth() ) > parseInt( crop_bg_canvas.getWidth() ) ) {
				crop_bg_canvas.item(1).scaleToWidth(parseInt( crop_bg_canvas.getWidth() ));
			}
			if (parseInt( crop_bg_canvas.item(1).getHeight() ) > parseInt( crop_bg_canvas.getHeight() )) {
				crop_bg_canvas.item(1).scaleToHeight(parseInt( crop_bg_canvas.getHeight() ));
			}
			crop_bg_canvas.item(1).centerV();
			crop_bg_canvas.item(1).centerH();
			crop_bg_canvas.item(1).cornerSize = crop_img_corners_size;
			crop_bg_canvas.item(1).lockUniScaling = 1;
			crop_bg_canvas.item(1).setCoords();
			crop_bg_canvas.setActiveObject(crop_bg_canvas.item(1));
			crop_bg_canvas.renderAll()
		})
	}
	function ValidURL(str) {
		var regexp =  /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
		if (regexp.test(str)){
		  return true;
		}else{
		  return false;
		}
	}
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	function _getSelection(){
		if(canvas.getActiveObject()){
			return [ canvas.getActiveObject() ];
		}else if(canvas.getActiveGroup()){
			return canvas.getActiveGroup().getObjects();
		}
		return [];
	}
	function ed_common_feature(d){
		if(d.stroke != undefined && d.stroke){
			$('#pg_stroke_enable').prop('checked', true);
			$('.pg_stroke_enable').removeClass('hide');
			$('#pg_stroke_colorPicker').val(d.stroke);
			$('#pg_stroke_width').val(d.strokeWidth);
			//$('#pg_stroke_colorPicker').colorpicker().change();
			$('#pg_stroke_colorPicker').parent().css("color", d.stroke);

		}else{
			$('#pg_stroke_enable').prop('checked', false);
			$('.pg_stroke_enable').addClass('hide');
			$('#pg_stroke_colorPicker').val('#202020');
			$('#pg_stroke_width').val(1);
			
		}
		if(d.shadow){
			$('#ed_shadow_enable').prop('checked', true);
			$('.ed_shadow_enable').removeClass('hide');
			$('#ed_shadow_colorPicker').val(d.shadow.color);
			$('#ed_shadow_offsetX').val(d.shadow.offsetX);
			$('#ed_shadow_offsetY').val(d.shadow.offsetY);
			$('#ed_shadow_blur').val(d.shadow.blur);
			//$('#ed_shadow_colorPicker').colorpicker().change();
			$('#ed_shadow_colorPicker').parent().css("color", d.shadow.color);
            
		}else{
			$('#ed_shadow_enable').prop('checked', false);
			$('.ed_shadow_enable').addClass('hide');
			$('#ed_shadow_colorPicker').val('#202020');
			$('#ed_shadow_offsetX').val(10);
			$('#ed_shadow_offsetY').val(10);
			$('#ed_shadow_blur').val(10);
			
		}
		if(typeof d.fill == 'object'){
			$("#ed_gradient_color_colorPicker_1").val(d.fill.colorStops[0].color);
			$("#ed_gradient_color_colorPicker_2").val(d.fill.colorStops[1].color);
			var deltaX = d.fill.coords.x2 - d.fill.coords.x1;
			var deltaY = d.fill.coords.y2 - d.fill.coords.y1;
			var rad = Math.atan2(deltaY, deltaX) * (180 / Math.PI);
			if(rad < 0){
				rad = 360 + rad;
			}			
			$("#ed_gradient_color_angle").prev().children().val(rad);
			$("#ed_gradient_color_angle").val(rad).change();
			$("#ed_gradient_color_colorPicker_1").change();
			$("#ed_gradient_color_colorPicker_2").change();
			$('#pg_gradient_color_enable').prop('checked', true);
			$('.pg_gradient_color_enable').removeClass('hide');

			$('#ed_gradient_color_colorPicker_1').parent().css("color", d.fill.colorStops[0].color);
			$('#ed_gradient_color_colorPicker_2').parent().css("color", d.fill.colorStops[1].color);
			
		}else{
			$('#pg_gradient_color_enable').prop('checked', false);
			$('.pg_gradient_color_enable').addClass('hide');
		}
	}
	/**
	 * The Layer Panel 
	 */
	let layer_rename = '';
	function refreshLayer(){
		let objects = [...canvas.getObjects()];
		$(`.pxl-layers-list`).html('');
		$(`.px-layers-count`).text(objects.length);
		if(objects.length){
			objects.forEach((object, index) => {
				let txt = ``;
				if(!object.name && (object.type == "text" || object.type == "i-text")){
					txt = object.text;
				}else if(object.name){
					txt = object.name;
				}else{
					let str = object.type;
					let str2 = str.charAt(0).toUpperCase() + str.slice(1);
					txt = `${str2}`;
				}
				let html = `<div class="px-layers-item ${object.type} ${object.active ? 'active' : ''} ${object.visible === false ? 'layer_hide' : ''}" id="${index}-layer-drag">
					<div class="px-layers-dragger pxl-layers-dragger">
					<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 24 24" xml:space="preserve"><g><path d="M5 10.75A2.75 2.75 0 1 1 7.75 8 2.752 2.752 0 0 1 5 10.75zm0-4A1.25 1.25 0 1 0 6.25 8 1.252 1.252 0 0 0 5 6.75zm7 4A2.75 2.75 0 1 1 14.75 8 2.752 2.752 0 0 1 12 10.75zm0-4A1.25 1.25 0 1 0 13.25 8 1.252 1.252 0 0 0 12 6.75zm7 4A2.75 2.75 0 1 1 21.75 8 2.752 2.752 0 0 1 19 10.75zm0-4A1.25 1.25 0 1 0 20.25 8 1.252 1.252 0 0 0 19 6.75zm-14 12A2.75 2.75 0 1 1 7.75 16 2.752 2.752 0 0 1 5 18.75zm0-4A1.25 1.25 0 1 0 6.25 16 1.252 1.252 0 0 0 5 14.75zm7 4A2.75 2.75 0 1 1 14.75 16 2.752 2.752 0 0 1 12 18.75zm0-4A1.25 1.25 0 1 0 13.25 16 1.252 1.252 0 0 0 12 14.75zm7 4A2.75 2.75 0 1 1 21.75 16 2.752 2.752 0 0 1 19 18.75zm0-4A1.25 1.25 0 1 0 20.25 16 1.252 1.252 0 0 0 19 14.75z"/></g></svg>
					</div>
					<div class="px-layers-name pxl-layers-db-click">
						<p>${txt}</p>
						${layer_rename === index ? `<input type="text" value="${txt}" onclick="this.select()" class="pxl-layer-name-save" autofocus>` : `<div class="pxl-layers-select" data-index="${index}"></div>` }
					</div>
					<div class="px-layers-action">
						${layer_rename !== index ?
							`<div class="px-layers-action-btn pxl-layers-action-btn" title="Rename" data-action="rename">
								<svg version="1.1" x="0px" y="0px" viewBox="0 0 348.882 348.882" width="18" height="18"><g><path d="M333.988,11.758l-0.42-0.383C325.538,4.04,315.129,0,304.258,0c-12.187,0-23.888,5.159-32.104,14.153L116.803,184.231c-1.416,1.55-2.49,3.379-3.154,5.37l-18.267,54.762c-2.112,6.331-1.052,13.333,2.835,18.729c3.918,5.438,10.23,8.685,16.886,8.685c0,0,0.001,0,0.001,0c2.879,0,5.693-0.592,8.362-1.76l52.89-23.138c1.923-0.841,3.648-2.076,5.063-3.626L336.771,73.176C352.937,55.479,351.69,27.929,333.988,11.758z M130.381,234.247l10.719-32.134l0.904-0.99l20.316,18.556l-0.904,0.99L130.381,234.247z M314.621,52.943L182.553,197.53l-20.316-18.556L294.305,34.386c2.583-2.828,6.118-4.386,9.954-4.386c3.365,0,6.588,1.252,9.082,3.53l0.419,0.383C319.244,38.922,319.63,47.459,314.621,52.943z"></path><path d="M303.85,138.388c-8.284,0-15,6.716-15,15v127.347c0,21.034-17.113,38.147-38.147,38.147H68.904c-21.035,0-38.147-17.113-38.147-38.147V100.413c0-21.034,17.113-38.147,38.147-38.147h131.587c8.284,0,15-6.716,15-15s-6.716-15-15-15H68.904c-37.577,0-68.147,30.571-68.147,68.147v180.321c0,37.576,30.571,68.147,68.147,68.147h181.798c37.576,0,68.147-30.571,68.147-68.147V153.388C318.85,145.104,312.134,138.388,303.85,138.388z"></path></g></svg>
							</div>` 
							:
							`<div class="px-layers-action-btn pxl-layers-action-btn" title="Save" data-action="rename_save">
								<svg version="1.1" x="0px" y="0px" viewBox="0 0 360 360" width="16" height="16"><g><path d="M303.118,0H56.882C25.516,0,0,25.516,0,56.882v246.236C0,334.484,25.516,360,56.882,360h246.236C334.484,360,360,334.484,360,303.118V56.882C360,25.516,334.484,0,303.118,0z M322.078,303.118c0,10.454-8.506,18.96-18.959,18.96H56.882c-10.454,0-18.959-8.506-18.959-18.96V56.882c0-10.454,8.506-18.959,18.959-18.959h246.236c10.454,0,18.959,8.506,18.959,18.959V303.118z"></path><path d="M249.844,106.585c-6.116,0-11.864,2.383-16.19,6.71l-84.719,84.857l-22.58-22.578c-4.323-4.324-10.071-6.706-16.185-6.706c-6.115,0-11.863,2.382-16.187,6.705c-4.323,4.323-6.703,10.071-6.703,16.185c0,6.114,2.38,11.862,6.703,16.184l38.77,38.77c4.323,4.324,10.071,6.706,16.186,6.706c6.112,0,11.862-2.383,16.19-6.71L266.03,145.662c8.923-8.926,8.922-23.448,0-32.374C261.707,108.966,255.958,106.585,249.844,106.585z"></path></g></svg>
							</div>`
						}
						<div class="px-layers-action-btn pxl-layers-action-btn ${object.lockMovementX && object.lockMovementY ? 'active' : ''}" title="Lock" data-action="lock">
							<svg width="11" height="14" viewBox="0 0 11 14"><path d="M8.8433 4.66664H8.21335V3.33667C8.23668 2.90754 8.17227 2.4781 8.02412 2.07468C7.87597 1.67126 7.64716 1.30226 7.35164 0.990234C7.05612 0.678205 6.70004 0.429768 6.30526 0.259928C5.91049 0.0900883 5.48528 0.00244141 5.05552 0.00244141C4.62576 0.00244141 4.20056 0.0900883 3.80578 0.259928C3.411 0.429768 3.05493 0.678205 2.75941 0.990234C2.46389 1.30226 2.23507 1.67126 2.08692 2.07468C1.93877 2.4781 1.87436 2.90754 1.8977 3.33667V4.66664H1.25996C0.917014 4.67742 0.592173 4.82315 0.356195 5.07224C0.120218 5.32133 -0.00779093 5.65358 -3.30913e-05 5.99661V12.67C-0.00779093 13.013 0.120218 13.3453 0.356195 13.5944C0.592173 13.8435 0.917014 13.9892 1.25996 14H8.8433C9.18754 13.991 9.51421 13.8461 9.75181 13.5968C9.98941 13.3476 10.1186 13.0143 10.1111 12.67V5.99661C10.1186 5.65233 9.98941 5.31903 9.75181 5.06977C9.51421 4.82051 9.18754 4.67561 8.8433 4.66664ZM5.05552 10.6633C4.78952 10.6776 4.52533 10.6117 4.29711 10.4743C4.0689 10.3369 3.8871 10.1343 3.7753 9.89252C3.6635 9.65073 3.62687 9.38085 3.67001 9.11797C3.71315 8.8551 3.83411 8.61125 4.01731 8.41786C4.20052 8.22447 4.43752 8.09061 4.69768 8.03334C4.95784 7.97607 5.22921 7.998 5.47669 8.09657C5.72417 8.19515 5.93641 8.36583 6.08594 8.58629C6.23548 8.80675 6.31544 9.06692 6.31552 9.33331C6.32165 9.67588 6.19303 10.0072 5.95739 10.256C5.72175 10.5047 5.39793 10.6509 5.05552 10.6633ZM7.01554 4.66664H3.09551V3.33667C3.08048 3.06999 3.12001 2.80292 3.21172 2.55206C3.30342 2.30119 3.44542 2.07169 3.6289 1.87758C3.81238 1.68346 4.03348 1.52886 4.27879 1.42318C4.5241 1.3175 4.78842 1.2631 5.05552 1.2631C5.32263 1.2631 5.58695 1.3175 5.83226 1.42318C6.07756 1.52886 6.29867 1.68346 6.48214 1.87758C6.66562 2.07169 6.80762 2.30119 6.89933 2.55206C6.99103 2.80292 7.03057 3.06999 7.01554 3.33667V4.66664Z"/></svg>
						</div>
						<div class="px-layers-action-btn pxl-layers-action-btn hide" title="Delete" data-action="delete">
							<svg width="10" height="14" viewBox="0 0 10 14"><path d="M8.42475 3.41769H1.52357C1.34712 3.42036 1.17296 3.45781 1.01108 3.52807C0.849193 3.59833 0.702779 3.69998 0.580312 3.82704C0.457844 3.9541 0.361678 4.1042 0.297424 4.26856C0.23317 4.43292 0.202122 4.60824 0.205943 4.78468L0.914167 12.6494C0.909296 13.005 1.045 13.348 1.29175 13.604C1.5385 13.86 1.87633 14.0082 2.23179 14.0164H7.82359C8.17906 14.0082 8.51688 13.86 8.76363 13.604C9.01038 13.348 9.14609 13.005 9.14122 12.6494L9.74238 4.78468C9.7462 4.60824 9.71505 4.43292 9.6508 4.26856C9.58654 4.1042 9.49048 3.9541 9.36801 3.82704C9.24554 3.69998 9.09913 3.59833 8.93725 3.52807C8.77536 3.45781 8.6012 3.42036 8.42475 3.41769ZM3.21999 11.62C3.21999 11.7947 3.15063 11.9623 3.02707 12.0859C2.90352 12.2094 2.73596 12.2789 2.56123 12.2789C2.38649 12.2789 2.21893 12.2094 2.09538 12.0859C1.97182 11.9623 1.90236 11.7947 1.90236 11.62V5.46827C1.90236 5.29354 1.97182 5.12597 2.09538 5.00242C2.21893 4.87887 2.38649 4.80941 2.56123 4.80941C2.73596 4.80941 2.90352 4.87887 3.02707 5.00242C3.15063 5.12597 3.21999 5.29354 3.21999 5.46827V11.62ZM5.52591 11.62C5.52591 11.7947 5.45645 11.9623 5.3329 12.0859C5.20934 12.2094 5.04178 12.2789 4.86705 12.2789C4.69232 12.2789 4.52475 12.2094 4.4012 12.0859C4.27765 11.9623 4.20828 11.7947 4.20828 11.62V5.46827C4.20828 5.29354 4.27765 5.12597 4.4012 5.00242C4.52475 4.87887 4.69232 4.80941 4.86705 4.80941C5.04178 4.80941 5.20934 4.87887 5.3329 5.00242C5.45645 5.12597 5.52591 5.29354 5.52591 5.46827V11.62ZM7.82359 11.62C7.82359 11.7065 7.80654 11.7922 7.77343 11.8721C7.74032 11.9521 7.69175 12.0247 7.63058 12.0859C7.5694 12.147 7.49678 12.1955 7.41685 12.2286C7.33692 12.2617 7.25124 12.2789 7.16473 12.2789C7.07821 12.2789 6.99253 12.2617 6.9126 12.2286C6.83267 12.1955 6.76006 12.147 6.69888 12.0859C6.6377 12.0247 6.58914 11.9521 6.55603 11.8721C6.52292 11.7922 6.50586 11.7065 6.50586 11.62V5.46827C6.50586 5.38175 6.52292 5.29608 6.55603 5.21614C6.58914 5.13621 6.6377 5.0636 6.69888 5.00242C6.76006 4.94124 6.83267 4.89278 6.9126 4.85967C6.99253 4.82656 7.07821 4.80941 7.16473 4.80941C7.25124 4.80941 7.33692 4.82656 7.41685 4.85967C7.49678 4.89278 7.5694 4.94124 7.63058 5.00242C7.69175 5.0636 7.74032 5.13621 7.77343 5.21614C7.80654 5.29608 7.82359 5.38175 7.82359 5.46827V11.62ZM0.831733 2.39652L9.05888 2.38828C9.16927 2.38635 9.27817 2.36264 9.37937 2.31851C9.48056 2.27438 9.57197 2.2107 9.64848 2.13113C9.725 2.05155 9.78508 1.95752 9.82521 1.85467C9.86534 1.75182 9.88482 1.64215 9.88241 1.53177C9.88445 1.30966 9.79932 1.09555 9.64537 0.935439C9.49142 0.775329 9.2809 0.681941 9.05888 0.675271L6.53059 0.683515C6.46672 0.486407 6.34252 0.314388 6.17553 0.191729C6.00853 0.0690712 5.80719 0.00211672 5.6 0.00012207H4.62005C4.41329 0.00382408 4.21269 0.0715244 4.04603 0.193941C3.87937 0.316358 3.75483 0.48733 3.68946 0.683515H0.831733C0.611081 0.693193 0.402689 0.787742 0.249975 0.947302C0.0972603 1.10686 0.0120239 1.31915 0.0120239 1.54002C0.0120239 1.76088 0.0972603 1.97317 0.249975 2.13273C0.402689 2.29229 0.611081 2.38684 0.831733 2.39652Z"/></svg>
						</div>
						<div class="px-layers-action-btn pxl-layers-action-btn" title="Show/Hide" data-action="showhide">
							${object.visible === true ?
								`<svg width="33" height="22" style="width:16px;" viewBox="0 0 33 22"><path d="M32.62 10.53C29.25 4.30003 23.34 0.530029 16.8 0.530029C10.26 0.530029 4.33997 4.30003 0.999971 10.53L0.719971 11L0.979971 11.48C4.34997 17.71 10.26 21.48 16.8 21.48C23.34 21.48 29.26 17.76 32.62 11.48L32.88 11L32.62 10.53ZM16.8 19.43C11.17 19.43 5.99997 16.29 2.99997 11C5.99997 5.71003 11.17 2.57003 16.8 2.57003C22.43 2.57003 27.54 5.72003 30.59 11C27.54 16.29 22.42 19.43 16.8 19.43Z"/><path d="M17.09 4.16998C15.7341 4.17988 14.4115 4.59136 13.2894 5.35246C12.1672 6.11356 11.2958 7.19014 10.7851 8.44622C10.2745 9.70231 10.1475 11.0815 10.4203 12.4097C10.693 13.738 11.3533 14.9555 12.3176 15.9087C13.2819 16.8619 14.5071 17.5079 15.8384 17.7652C17.1697 18.0225 18.5474 17.8794 19.7974 17.3542C21.0475 16.8289 22.1138 15.945 22.8618 14.8141C23.6098 13.6831 24.0059 12.3559 24 11C23.996 10.0974 23.8141 9.2045 23.4644 8.3724C23.1148 7.5403 22.6044 6.78538 21.9625 6.15089C21.3205 5.5164 20.5597 5.01482 19.7236 4.6749C18.8875 4.33498 17.9925 4.1634 17.09 4.16998ZM17.09 15.89C16.1322 15.8801 15.1987 15.5875 14.4068 15.0488C13.6148 14.5101 12.9997 13.7495 12.6386 12.8623C12.2775 11.9752 12.1867 11.0011 12.3774 10.0625C12.5681 9.12391 13.0319 8.26258 13.7105 7.5867C14.3892 6.91081 15.2524 6.45053 16.1918 6.26365C17.1312 6.07677 18.1048 6.17162 18.9905 6.5363C19.8762 6.90098 20.6343 7.51923 21.1697 8.31339C21.7052 9.10754 21.994 10.0422 22 11C22.0026 11.6446 21.8773 12.2833 21.6313 12.8791C21.3852 13.4749 21.0233 14.0159 20.5666 14.4708C20.1098 14.9257 19.5674 15.2853 18.9706 15.5289C18.3738 15.7726 17.7345 15.8953 17.09 15.89Z"/></svg>` 
								:
								`<svg width="36" height="28" style="width:16px;" viewBox="0 0 36 28"><path d="M30.825 1.51245C30.825 1.17495 30.7125 0.949951 30.4875 0.724951C30.2625 0.499951 30.0375 0.387451 29.7 0.387451C29.3625 0.387451 29.1375 0.499951 28.9125 0.724951L25.875 3.76245C23.625 2.63745 21.0375 1.96245 18 1.62495C12.375 2.18745 7.875 4.21245 4.725 7.81245C1.575 11.4125 0 13.4375 0 14C0 14.5625 1.6875 16.5875 4.725 20.1875C5.5125 21.0875 6.3 21.875 7.3125 22.55L4.275 25.7C4.05 25.925 3.9375 26.15 3.9375 26.4875C3.9375 26.825 4.05 27.05 4.275 27.275C4.5 27.5 4.725 27.6125 5.0625 27.6125C5.4 27.6125 5.625 27.5 5.85 27.275L30.6 2.29995C30.7125 2.07495 30.825 1.84995 30.825 1.51245ZM8.1 20.075C5.4 17.6 3.6 15.575 2.7 14C3.7125 12.3125 5.5125 10.2875 8.1 7.92495C10.6875 5.56245 14.0625 4.09995 18 3.87495C20.25 3.98745 22.3875 4.54995 24.1875 5.44995L22.275 7.36245C21.0375 6.57495 19.6875 6.12495 18 6.12495C15.75 6.12495 13.95 6.91245 12.375 8.37495C10.8 9.83745 10.125 11.75 10.125 14C10.125 15.6875 10.575 17.15 11.3625 18.3875L9 20.8625C8.6625 20.6375 8.325 20.3 8.1 20.075ZM13.05 16.7C12.6 15.9125 12.375 15.0125 12.375 14C12.375 12.425 12.9375 11.075 14.0625 10.0625C15.1875 9.04995 16.425 8.37495 18 8.37495C19.0125 8.37495 19.9125 8.59995 20.5875 9.04995L13.05 16.7ZM31.275 7.81245C30.825 7.24995 30.2625 6.79995 29.8125 6.34995L28.125 8.03745C30.7125 10.4 32.5125 12.425 33.4125 14C32.4 15.6875 30.6 17.7125 28.0125 20.075C25.425 22.4375 21.9375 23.9 18 24.125C16.2 24.0125 14.5125 23.675 13.05 23.1125L11.3625 24.8C13.3875 25.5875 15.525 26.15 18 26.375C23.625 25.8125 28.125 23.7875 31.275 20.1875C34.425 16.5875 36 14.5625 36 14C36 13.4375 34.3125 11.4125 31.275 7.81245Z" fill="black"/><path d="M18 19.625C17.55 19.625 17.1 19.5125 16.65 19.4L14.85 21.2C15.8625 21.65 16.875 21.875 18 21.875C20.25 21.875 22.05 21.0875 23.625 19.625C25.0875 18.1625 25.875 16.25 25.875 14C25.875 12.875 25.65 11.75 25.2 10.85L23.4 12.65C23.5125 13.1 23.625 13.55 23.625 14C23.625 15.575 23.0625 16.925 21.9375 17.9375C20.8125 18.95 19.575 19.625 18 19.625Z"/></svg>`
							}
							
						</div>
					</div>
					
				</div>`;
				$(`.pxl-layers-list`).prepend(html);
		
			});
		}else{
			let html = `<p class="no_search_result" style="display: block;">No layer found.</p>`;
			$(`.pxl-layers-list`).prepend(html);
		}
	} 
	
	if ($(".pxl-layers-list").length) {
		
			$(document).on('click', `.pxl-layers-select`, function(e){
				let index = $(this).data('index');
				canvas.deactivateAll().renderAll();
				layer_rename = false;
				if(e.ctrlKey){
					$(this).parents(`.px-layers-item`).addClass('active');
					let activeObject = [];
					let objects = canvas.getObjects();
					$(`.px-layers-item.active`).each((ao, item) => {
						let i = $(item).find('.pxl-layers-select').data('index');
						objects[i].set('active', true);
						activeObject.push(objects[i]);
					});
					let group = new fabric.Group(activeObject.slice().reverse(), {
						originX: "center",
						originY: "center",
						addGroupOps: "yes",
						rightclickoption: 1
					});
					//canvas.add(group);
					canvas.setActiveGroup(group);
					canvas.renderAll();
					canvas.trigger("selection:created", {
						target: group,
					});
				}else{		
					/*if($(this).parents(`.px-layers-item`).hasClass('active')){
						$(`.px-layers-item`).removeClass('active');			
						canvas.deactivateAll().renderAll();
					}else{*/
						$(`.px-layers-item`).removeClass('active');			
						$(this).parents(`.px-layers-item`).addClass('active');
						let objects = canvas.getObjects();
						canvas._setActiveObject(objects[index]);
						canvas.trigger("mouse:down", {
							target: objects[index],
						});
					//}
				}

			});
			
			$(document).on('click', `.pxl-layers-action-btn`, function(e){
				
				let action = $(this).data('action');		
				let index = $(this).parents(`.px-layers-item`).find(`.pxl-layers-select`).data('index');
				if(action != 'rename' && action != 'rename_save'){
					$(this).parents(`.px-layers-item`).find(`.pxl-layers-select`).click();
				}
				setTimeout(() => {
					if(action == 'delete'){
						$(`.ed_delete_layer`).eq(0).trigger('click');
						let objects = canvas.getObjects();
						canvas.trigger("object:modified", {
							target: objects[index],
						});
					}
					if(action == 'lock'){
						$(`.ed_lock_layer`).eq(0).trigger('click');
						let objects = canvas.getObjects();
						canvas.trigger("object:modified", {
							target: objects[index],
						});
					}
					/* if(action == 'duplicate'){
						$(`.ed_element_copy`).eq(0).trigger('click');
					} */
					if(action == 'rename'){
						layer_rename = index;
						refreshLayer();
					}
					if(action == 'rename_save'){
						let index = layer_rename;
						layer_rename = false;
						let objects = canvas.getObjects();
						objects[index].set('name', $('.pxl-layer-name-save').val());
						refreshLayer();
					}
					if(action == 'showhide'){
						let objects = canvas.getObjects();
						if(objects[index].visible){
							objects[index].set('visible', false);
						}else{
							objects[index].set('visible', true);
						}
						canvas.renderAll();
						refreshLayer();
					}
					
				}, 50);
			});
			$(document).on('keyup', `.pxl-layer-name-save`, function(e){
				
				if(e.keyCode === 13){
					let index = layer_rename;
					layer_rename = false;
					let objects = canvas.getObjects();
					objects[index].set('name', $(this).val());
					refreshLayer();
				}
			});
	
			$(".pxl-layers-list").sortable({
				handle: ".pxl-layers-dragger",
				axis: "y",
				start: function (event, ui) {
					layer_rename = false;
				},
				update: function (event, ui) {
					var orders = $(this).sortable("toArray");
					let objects = [...canvas.getObjects()];
					orders.slice().reverse().forEach((order, i)=>{
						let index = order.split('-')[0];
						canvas.moveTo(objects[index],i);
					});
					canvas.renderAll();
					refreshLayer();
				},
			});
		 $(".pxl-layers-list").disableSelection();
	 }
	 /**
	  * Layer Section Open Close
	  */
	 $(document).on('click','.px-layer-drawer',function(){
        $("body").toggleClass("px-layers-opened");
	 }) 
	 $(document).on('click','.pxl-layers-close',function(){
        $("body").toggleClass("px-layers-opened");
	 })  

})( jQuery );  
