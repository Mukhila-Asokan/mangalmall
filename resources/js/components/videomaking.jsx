import { useState, useEffect, useRef } from 'react';
import {
  Upload, Play, Download, Loader2, X, FilePlus, CheckCircle, AlertCircle, Trash2, Edit, Type, PlusCircle
} from 'lucide-react';

export default function VideoCreator() {
  const [images, setImages] = useState([]);
  const [audio, setAudio] = useState(null);
  const [videoUrl, setVideoUrl] = useState('');
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const videoRef = useRef(null);
  const [duration, setDuration] = useState(2);
  const [editingIndex, setEditingIndex] = useState(null);
  const [editDuration, setEditDuration] = useState(2);
  const [animationEffect, setAnimationEffect] = useState('fade');
  
  // New state for text overlays
  const [textOverlays, setTextOverlays] = useState([]);
  const [newTextOverlay, setNewTextOverlay] = useState({
    text: '',
    color: '#000000',
    fontSize: 24,
    position: 'center',
    duration: 2
  });

  const MAX_IMAGE_SIZE = 10 * 1024 * 1024;
  const MAX_AUDIO_SIZE = 20 * 1024 * 1024;

  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

 
  const handleImageUpload = (e) => {
    const files = Array.from(e.target.files);
    const validFiles = [];

    files.forEach(file => {
      if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
        setError(`Invalid file type: ${file.name}`);
      } else if (file.size > MAX_IMAGE_SIZE) {
        setError(`File too large: ${file.name}`);
      } else {
        validFiles.push({
          file,
          preview: URL.createObjectURL(file),
          duration: duration
        });
      }
    });

    if (validFiles.length > 0) {
      setImages(prev => [...prev, ...validFiles]);
      setError('');
    }
    e.target.value = '';
  };

  const handleAudioUpload = (e) => {
    const file = e.target.files[0];
    if (!file) return;

    if (!['audio/mpeg', 'audio/wav', 'audio/ogg'].includes(file.type)) {
      setError('Invalid audio format. Accepted: MP3, WAV, OGG');
      return;
    }
    if (file.size > MAX_AUDIO_SIZE) {
      setError('Audio file is too large (Max 20MB)');
      return;
    }

    setAudio({
      file,
      preview: URL.createObjectURL(file),
      name: file.name
    });
    setError('');
    e.target.value = '';
  };

  const handleRemoveImage = (index) => {
    const newImages = [...images];
    URL.revokeObjectURL(newImages[index].preview);
    newImages.splice(index, 1);
    setImages(newImages);
  };

  const handleRemoveAudio = () => {
    if (audio) {
      URL.revokeObjectURL(audio.preview);
      setAudio(null);
    }
  };

  const startEditDuration = (index) => {
    setEditingIndex(index);
    setEditDuration(images[index].duration);
  };

  const saveEditDuration = () => {
    const newImages = [...images];
    newImages[editingIndex].duration = editDuration;
    setImages(newImages);
    setEditingIndex(null);
  };

  // New method to add text overlay
  const addTextOverlay = () => {
    if (newTextOverlay.text.trim()) {
      setTextOverlays(prev => [...prev, { ...newTextOverlay }]);
      // Reset the form
      setNewTextOverlay({
        text: '',
        color: '#000000',
        fontSize: 24,
        position: 'center',
        duration: 2
      });
    }
  };

  // Method to remove text overlay
  const removeTextOverlay = (index) => {
    const newTextOverlays = [...textOverlays];
    newTextOverlays.splice(index, 1);
    setTextOverlays(newTextOverlays);
  };

  // Update createVideo method to include text overlays
  const createVideo = async () => {
    if (images.length === 0) {
      setError('Please upload at least one image');
      return;
    }
    if (!audio) {
      setError('Please upload an audio file');
      return;
    }

    setIsLoading(true);
    setError('');
    setSuccess('');

    try {
      const formData = new FormData();
      images.forEach((image, index) => {
        formData.append(`images[]`, image.file);
        formData.append(`durations[]`, image.duration);
      });
      formData.append('audio', audio.file);
      formData.append('duration', duration);
      formData.append('effect', animationEffect);
      
      // Add text overlays to form data
      textOverlays.forEach((overlay, index) => {
        formData.append(`texts[${index}][text]`, overlay.text);
        formData.append(`texts[${index}][color]`, overlay.color);
        formData.append(`texts[${index}][fontSize]`, overlay.fontSize);
        formData.append(`texts[${index}][position]`, overlay.position);
        formData.append(`texts[${index}][duration]`, overlay.duration);
      });

      const response = await fetch('/api/create-video', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        body: formData,
      });

      if (!response.ok) {
        throw new Error('Failed to create video');
      }

      const data = await response.json();
      setVideoUrl(data.video_url || data.videoUrl);
      setSuccess('Video created successfully!');
    } catch (err) {
      setError(err.message || 'Something went wrong');
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="container-fluid my-5 border-0" >
      <div className="row">
        <div className="col-lg-12 col-md-12 col-sm-12 mx-auto">
          <div className="card shadow-lg rounded-3">
            <div className="card-header bg-primary text-white d-flex justify-content-between align-items-center">
              <h2 className="mb-0 text-white p-3"> Video Creator</h2>
            </div>
            <div className="card-body">
              {/* Images Upload Section */}
              <div className="row mb-4">
                <div className="col-md-6">
                  <div className="card h-100">
                    <div className="card-header">
                      <h5 className="mb-0 p-3">Upload Images </h5>
                    </div>
                    <div className="card-body">
                      <div className="d-flex flex-wrap gap-2">
                        {images.map((image, index) => (
                          <div key={index} className="position-relative border rounded p-2" style={{ width: '120px' }}>
                            <img
                              src={image.preview}
                              alt="preview"
                              className="img-thumbnail"
                              style={{ width: '100px', height: '100px', objectFit: 'cover' }}
                            />
                            <button
                              onClick={() => handleRemoveImage(index)}
                              className="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                              title="Remove"
                            >
                              <Trash2 size={14} />
                            </button>
                            <div className="mt-2 text-center">

                            {editingIndex === index ? (
                              <>
                                <input
                                  type="number"
                                  min="1"
                                  max="10"
                                  value={editDuration}
                                  onChange={(e) => setEditDuration(parseInt(e.target.value))}
                                  className="form-control form-control-sm"
                                />
                                <button
                                  onClick={saveEditDuration}
                                  className="btn btn-success btn-sm mt-1"
                                >
                                  Save
                                </button>
                              </>
                            ) : (
                              <>
                                <small>{image.duration}s</small>
                                <button
                                  onClick={() => startEditDuration(index)}
                                  className="btn btn-link btn-sm"
                                >
                                  <Edit size={14} />
                                </button>
                              </>
                            )}
                            </div>
                          </div>
                        ))}
                        <label
                          className="border rounded d-flex flex-column align-items-center justify-content-center text-muted"
                          style={{ width: '100px', height: '100px', cursor: 'pointer' }}
                        >
                          <Upload size={20} />
                          <input
                            type="file"
                            multiple
                            accept="image/*"
                            className="d-none"
                            onChange={handleImageUpload}
                          />
                          <small>Add Images</small>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                {/* Audio Upload Section */}
                <div className="col-md-6">
                  <div className="card h-100">
                    <div className="card-header">
                      <h5 className="mb-0 p-3">  Upload Audio </h5>
                    </div>
                    <div className="card-body">
                      <div className="text-center">
                        <label className="btn btn-outline-primary w-100">
                          <FilePlus className="me-2" />
                          Choose Audio File
                          <input
                            type="file"
                            accept="audio/*"
                            className="d-none"
                            onChange={handleAudioUpload}
                          />
                        </label>
                        {audio && (
                          <div className="mt-3">
                            <audio controls className="w-100">
                              <source src={audio.preview} type={audio.file.type} />
                            </audio>
                            <button
                              onClick={handleRemoveAudio}
                              className="btn btn-danger btn-sm mt-2"
                            >
                              Remove Audio
                            </button>
                          </div>
                        )}
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {/* Text Overlay Section */}
              <div className="card mb-4">
                <div className="card-header">
                  <h5 className="mb-0 p-3">
                    <Type className="me-2" /> Text Overlays
                  </h5>
                </div>
                <div className="card-body">
                  <div className="row g-3">
                    <div className="col-md-6">
                      <input
                        type="text"
                        className="form-control"
                        placeholder="Enter text to overlay"
                        value={newTextOverlay.text}
                        onChange={(e) => setNewTextOverlay(prev => ({
                          ...prev,
                          text: e.target.value
                        }))}
                      />
                    </div>
                    <div className="col-md-2">
                      <input
                        type="color"
                        className="form-control form-control-color"
                        value={newTextOverlay.color}
                        onChange={(e) => setNewTextOverlay(prev => ({
                          ...prev,
                          color: e.target.value
                        }))}
                        title="Choose text color"
                      />
                    </div>
                    <div className="col-md-2">
                      <select
                        className="form-select"
                        value={newTextOverlay.fontSize}
                        onChange={(e) => setNewTextOverlay(prev => ({
                          ...prev,
                          fontSize: parseInt(e.target.value)
                        }))}
                      >
                        <option value={16}>Small</option>
                        <option value={24}>Medium</option>
                        <option value={32}>Large</option>
                      </select>
                    </div>
                    <div className="col-md-2">
                      <select
                        className="form-select"
                        value={newTextOverlay.position}
                        onChange={(e) => setNewTextOverlay(prev => ({
                          ...prev,
                          position: e.target.value
                        }))}
                      >
                        <option value="center">Center</option>
                        <option value="top">Top</option>
                        <option value="bottom">Bottom</option>
                      </select>
                    </div>
                    <div className="col-12 p-3">
                      <button
                        onClick={addTextOverlay}
                        className="btn btn-success"
                        disabled={!newTextOverlay.text.trim()}
                      >
                        <PlusCircle className="me-2" /> Text Overlay
                      </button>
                    </div>
                  </div>

                  {/* List of Added Text Overlays */}
                  {textOverlays.length > 0 && (
                    <div className="mt-3">
                      <h6>Added Text Overlays:</h6>
                      <div className="list-group">
                        {textOverlays.map((overlay, index) => (
                          <div 
                            key={index} 
                            className="list-group-item d-flex justify-content-between align-items-center"
                          >
                            <span 
                              style={{ 
                                color: overlay.color, 
                                fontSize: `${overlay.fontSize}px` 
                              }}
                            >
                              {overlay.text} 
                              <small className="text-muted ms-2">
                                ({overlay.position} | {overlay.fontSize}px)
                              </small>
                            </span>
                            <button
                              onClick={() => removeTextOverlay(index)}
                              className="btn btn-sm btn-outline-danger"
                            >
                              <X size={16} />
                            </button>
                          </div>
                        ))}
                      </div>
                    </div>
                  )}
                </div>
              </div>

              {/* Video Settings */}
              <div className="card mb-4">
                <div className="card-header">
                  <h5 className="mb-0 p-3">Video Settings</h5>
                </div>
                <div className="card-body">
                  <div className="row g-3">
                    <div className="col-md-6">
                      <label className="form-label">Image Duration: {duration}s</label>
                      <input
                        type="range"
                        className="form-range"
                        min="1"
                        max="10"
                        value={duration}
                        onChange={(e) => setDuration(parseInt(e.target.value))}
                      />
                    </div>
                    <div className="col-md-6">
                      <label className="form-label">Animation Effect</label>
                      <select
                        className="form-select"
                        value={animationEffect}
                        onChange={(e) => setAnimationEffect(e.target.value)}
                      >
                        <option value="fade">Fade In/Out</option>
                        <option value="zoom">Zoom In</option>
                        <option value="slide">Slide</option>
                        <option value="none">None</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              {/* Error and Success Messages */}
              {error && (
                <div className="alert alert-danger d-flex align-items-center">
                  <AlertCircle className="me-2" size={18} />
                  {error}
                </div>
              )}
              {success && (
                <div className="alert alert-success d-flex align-items-center">
                  <CheckCircle className="me-2" size={18} />
                  {success}
                </div>
              )}

              {/* Create Video Button */}
              <button
                onClick={createVideo}
                disabled={isLoading || images.length === 0 || !audio}
                className={`btn btn-primary btn-lg w-100 d-flex justify-content-center align-items-center gap-2 ${
                  isLoading || images.length === 0 || !audio ? 'disabled' : ''
                }`}
              >
                {isLoading ? (
                  <>
                    <Loader2 className="spinner-border spinner-border-sm me-2" />
                    <span>Processing...</span>
                  </>
                ) : (
                  <>
                    <Play size={18} />
                    <span>Create Video</span>
                  </>
                )}
              </button>

              {/* Video Preview */}
              {videoUrl && (
                <div className="mt-5 card">
                  <div className="card-header bg-success text-white">
                    <h4 className="mb-0">Video Preview</h4>
                  </div>
                  <div className="card-body">
                    <video
                      ref={videoRef}
                      controls
                      src={videoUrl}
                      className="w-100 rounded border"
                    />
                    <a
                      href={videoUrl}
                      download="created-video.mp4"
                      className="btn btn-success mt-3 d-inline-flex align-items-center gap-2"
                    >
                      <Download size={16} />
                      <span>Download Video</span>
                    </a>
                  </div>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}