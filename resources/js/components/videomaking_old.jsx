import { useState, useEffect, useRef } from 'react';
import {
  Upload, Play, Download, Loader2, X, FilePlus, CheckCircle, AlertCircle, Trash2, Edit
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
        formData.append(`images[${index}]`, image.file); // <- required by Laravel validation
        formData.append(`durations[${index}]`, image.duration); // optional if needed
      });
      formData.append('audio', audio.file);
      formData.append('duration', duration); // ✅ Laravel requires this

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

  useEffect(() => {
    return () => {
      images.forEach(image => URL.revokeObjectURL(image.preview));
      if (audio) URL.revokeObjectURL(audio.preview);
    };
  }, [images, audio]);

 return (
    <div className="container my-5">
      <h1 className="text-center mb-4">Create Video from Images & Audio</h1>

      <div className="row">
        <div className="col-md-6">
          <label className="form-label">Upload Images</label>
          <div className="d-flex flex-wrap gap-2">
            {images.map((image, index) => (
              <div key={index} className="position-relative border rounded p-2 me-2 mb-2">
                <img src={image.preview} alt="preview" className="img-thumbnail" style={{ width: '100px', height: '100px', objectFit: 'cover' }} />
                <button onClick={() => handleRemoveImage(index)} className="btn-close position-absolute top-0 end-0"></button>
                <div className="mt-1 text-center">
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
                      <button onClick={saveEditDuration} className="btn btn-success btn-sm mt-1">Save</button>
                    </>
                  ) : (
                    <>
                      <small>{image.duration}s</small>
                      <button onClick={() => startEditDuration(index)} className="btn btn-link btn-sm">Edit</button>
                    </>
                  )}
                </div>
              </div>
            ))}
            <label className="border rounded d-flex flex-column align-items-center justify-content-center" style={{ width: '100px', height: '100px', cursor: 'pointer' }}>
              <Upload size={20} />
              <input type="file" multiple accept="image/*" className="d-none" onChange={handleImageUpload} />
            </label>
          </div>
        </div>

        <div className="col-md-6">
          <label className="form-label">Upload Audio</label>
          <div className="border rounded p-3 text-center">
            <label className="form-label">
              <FilePlus className="mb-2" />
              <input type="file" accept="audio/*" className="form-control d-none" onChange={handleAudioUpload} />
              <span className="d-block">Choose Audio File</span>
            </label>
            {audio && (
              <div className="mt-3">
                <audio controls className="w-100">
                  <source src={audio.preview} type={audio.file.type} />
                </audio>
                <button onClick={handleRemoveAudio} className="btn btn-danger btn-sm mt-2">Remove</button>
              </div>
            )}
          </div>
        </div>
      </div>

      <div className="my-4">
        <label className="form-label">Default duration per image: {duration}s</label>
        <input type="range" className="form-range" min="1" max="10" value={duration} onChange={(e) => setDuration(parseInt(e.target.value))} />
      </div>

      {error && <div className="alert alert-danger d-flex align-items-center"><AlertCircle className="me-2" size={18} /> {error}</div>}
      {success && <div className="alert alert-success d-flex align-items-center"><CheckCircle className="me-2" size={18} /> {success}</div>}

      <button
        type="button"
        onClick={createVideo}
        disabled={isLoading || images.length === 0 || !audio}
        className={`btn btn-primary w-100 d-flex justify-content-center align-items-center gap-2 ${isLoading || images.length === 0 || !audio ? 'disabled' : ''}`}
      >
        {isLoading ? <><Loader2 className="spinner-border spinner-border-sm me-2" /><span>Processing...</span></> : <><Play size={18} /><span>Create Video</span></>}
      </button>

      {videoUrl && (
        <div className="mt-5">
          <h4>Video Preview</h4>
          <video ref={videoRef} controls src={videoUrl} className="w-100 rounded border" />
          <a href={videoUrl} download="created-video.mp4" className="btn btn-success mt-3 d-inline-flex align-items-center gap-2">
            <Download size={16} />
            <span>Download Video</span>
          </a>
        </div>
      )}
    </div>
  );
}
