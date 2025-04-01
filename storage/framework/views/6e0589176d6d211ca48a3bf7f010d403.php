
<?php $__env->startSection('content'); ?>
<div class="mt-1 col-lg-10 col-md-10">
    <div id="all_contacts_container" class="content-section">
    <div class="row">
        <div class="mt-1 col-lg-8 col-md-8">
    <article class="post">
    <div class="post-preview"><img src="<?php echo e(url('/').Storage::url($userblog->image)); ?>" alt="article" class="img-fluid" /></div>
            <div class="post-wrapper">
                <div class="post-header">
				
				
                    
					<h1 class="post-title"><?php echo e($userblog->title); ?></h1>
					
					<div class="d-flex justify-content-between align-items-center mt-2">
					<div>
					
                    <ul class="post-meta">
                        <li><?php echo e($userblog->created_at->format('F d, Y')); ?></li>
                        <li>In <a href="#"><?php echo e($userblog->category->categoryname ?? 'No Category'); ?></a></li>
                        <li><a href="#"><span class="fas fa-comments"></span> <?php echo e($userblog->comments); ?> </a></li>
                        <li><span class="fas fa-thumbs-up"></span> <span id="like-count"> <?php echo e($userblog->likes); ?> </span></li>
                    </ul>
					</div>
                    <div class="text-end">
					<button id="like-btn" 
							data-blog-id="<?php echo e($userblog->id); ?>"
							class="<?php echo e($userblog->isLikedByUser($user_id) ? 'btn btn-danger' : 'btn btn-outline-danger'); ?>">
						❤️ Like
					</button>

					
				</div>
				</div>				
								
								
				
				
				</div>
                <div class="post-content">
                    <?php echo $userblog->content; ?>

                </div>
                <div class="post-footer">
                  

                    <div class="d-flex justify-content-between align-items-center">
    <div>
    <div class="post-tags">
                      
                      <?php $__currentLoopData = explode(',', $userblog->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <a href="#"><?php echo e(trim($tag)); ?></a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
    </div>

    <div class="post-share">
        <ul class="list-inline m-0">
            <li class="list-inline-item"><a href="#"><span class="fab fa-facebook-f"></span></a></li>
            <li class="list-inline-item"><a href="#"><span class="fab fa-twitter"></span></a></li>
            <li class="list-inline-item"><a href="#"><span class="fab fa-linkedin"></span></a></li>
            <li class="list-inline-item"><a href="#"><span class="fab fa-instagram"></span></a></li>
        </ul>
    </div>
</div>



                </div>
		 </div>
    </article>
       
	</div>
        <div class="col-lg-4 col-md-4">
        <div class="sidebar-right pl-4">
             <!-- Search widget-->
             <aside class="widget widget-search">
                <form>
                    <input class="form-control" type="search" placeholder="Type Search Words">
                    <button class="search-button" type="submit"><span class="ti-search"></span></button>
                </form>
            </aside>
             <!-- Categories widget-->
             <aside class="widget widget-categories">
                <div class="widget-title">
                    <h6>Categories</h6>
                </div>
                <ul>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="#"><?php echo e($category->categoryname); ?> <span class="float-right"><?php echo e($category->blogs->count()); ?></span></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
                </ul>
            </aside>
              <!-- Tags widget-->
              <aside class="widget widget-tag-cloud">
                <div class="widget-title">
                    <h6>Tags</h6>
                </div>
                <div class="tag-cloud">
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#"><?php echo e($tag->tagname); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </aside>

                <!-- Recent entries widget-->
                <aside class="widget widget-recent-entries-custom">
                    <div class="widget-title">
                        <h6>Recent Posts</h6>
                    </div>
                    <ul>
                        <?php $__currentLoopData = $recentpost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentblog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="clearfix">
                            <div class="wi"><a href="<?php echo e(route('blog.show', $recentblog->id)); ?>"><img src="<?php echo e(url('/').Storage::url($recentblog->image)); ?>" alt="<?php echo e($recentblog->category->categoryname ?? 'No Category'); ?>" class="img-fluid rounded" /></a></div>
                            <div class="wb"><a href="<?php echo e(route('blog.show', $recentblog->id)); ?>"><?php echo e($recentblog->title); ?></a><span class="post-date"><?php echo e($recentblog->created_at->format('F d, Y')); ?></span></div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </ul>
                </aside>



        </div>
        </div>

        <hr>
    </div>    
</div>
</div>

<div class="col-lg-2 col-md-2">
<?php echo $__env->make('profile-layouts.rightside', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
</div>	
    <div class="row">
        <div class="col-lg-8 col-md-8 mx-auto">
            <div class="section-heading mb-5">
                <h2>Comments</h2>
            </div>

 <div class="comment-respond" id="comment-respond">
    <h5 class="comment-reply-title">Leave a Feedback</h5>
    <p class="comment-notes">Please add decent comments</p>
    <form id="commentForm">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="blog_id" value="<?php echo e($userblog->id); ?>">
        <input type="hidden" name="reply_id" id="reply_id">

        <textarea name="content" id="content" placeholder="Write your comment here..." class="form-control" required></textarea>
        <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
    </form>
</div>
<div id="comments-container"></div>

        </div>
                        <!-- Comments area end-->
        </div>
</div>
   


<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    
$(document).ready(function () {

    loadComments(); // Load comments on page load

    // Submit Comment or Reply
    $('#commentForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo e(route('comments.store')); ?>",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    loadComments(); // Refresh comments dynamically
                    $('#content').val(''); // Clear the textarea
                    $('#reply_id').val(''); // Reset reply ID
                    $('#comment-respond').appendTo('#comments-container'); // Return form to original place
                }
            },
            error: function (xhr) {
                alert('Failed to submit comment. Please try again.');
            }
        });
    });

    function renderReplies(replies) {
    let replyHtml = '';

    replies.forEach(reply => {
        replyHtml += `
            <div class="comment" id="comment-${reply.id}">
                <div class="comment-body">
                    <div class="comment-meta">
                        <div class="comment-meta-author">${reply.user?.name || 'Anonymous'}</div>
                        <div class="comment-meta-date">${reply.created_at}</div>
                    </div>
                    <div class="comment-content">
                        <p>${reply.content}</p>
                    </div>
                    <div class="comment-reply">
                        <a href="#" onclick="reply(${reply.id}, true)">Reply</a>
                    </div>
                </div>
                <div class="children">
                    ${renderReplies(reply.replies || [])}
                </div>
            </div>
        `;
    });

    return replyHtml;
}

function loadComments() {         
    $.ajax({
      url: "<?php echo e(route('comments.get', ['blogId' => $userblog->id])); ?>",
        type: "GET",
        success: function (comments) {
            let commentHtml = '';
            comments.forEach(comment => {
                commentHtml += `
                    <div class="comment" id="comment-${comment.id}">
                        <div class="comment-body">
                            <div class="comment-meta">
                                <div class="comment-meta-author">${comment.user?.name || 'Anonymous'}</div>
                                <div class="comment-meta-date">${comment.created_at}</div>
                            </div>
                            <div class="comment-content">
                                <p>${comment.content}</p>
                            </div>
                            <div class="comment-reply">
                                <a href="#" onclick="reply(${comment.id}, false)">Reply</a>
                            </div>
                        </div>
                        <div class="children">
                            ${renderReplies(comment.replies || [])}
                        </div>
                    </div>
                `;
            });

            $('#comments-container').html(commentHtml);
        }
    });
}


});


// Reply function to dynamically move form
function reply(commentId, isReply = false) {
    event.preventDefault(); // Prevent page refresh

    const commentChildren = $(`#comment-${commentId} .children`);

    // Create .children if not present
    if (!commentChildren.length) {
        $(`#comment-${commentId}`).append('<div class="children"></div>');
    }

    $('#reply_id').val(commentId); // Set the parent comment ID
    $('#comment-respond').appendTo(`#comment-${commentId} .children`).hide().fadeIn();
    $('#content').focus();
}


$(document).on('click', '.comment-reply a', function (e) {
    e.preventDefault();
    const commentId = $(this).closest('.comment').attr('id').split('-')[1];
    reply(commentId);
});

$(document).ready(function () {
    $('#like-btn').on('click', function () {
        const blogId = $(this).data('blog-id');

        $.ajax({
            url: `/home/bloglike/${blogId}`,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Required for POST requests in Laravel
            },
            success: function (response) {
                alert(response.message);

                // Refresh Like Count
                $.get(`/home/bloggetlikes/${blogId}`, function (data) {
                    $('#like-count').text(`${data.likes}`);
                });

                // Toggle Button Class
                $('#like-btn').toggleClass('btn-danger btn-outline-danger');
            },
            error: function () {
                alert('Something went wrong. Please try again.');
            }
        });
    });
});
</script>



<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/blog/show.blade.php ENDPATH**/ ?>