import { useState, useEffect, useRef } from 'react';
import { Upload, Play, Download, Loader2, X, FilePlus, CheckCircle, AlertCircle, Trash2, Edit } from 'lucide-react';

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
    e.target.value = ''; // Reset input to allow same file re-upload
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
    e.target.value = ''; // Reset input
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
        formData.append(`images[${index}][file]`, image.file);
        formData.append(`images[${index}][duration]`, image.duration);
      });
      formData.append('audio', audio.file);

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
    <div className="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
      <h1 className="text-2xl font-bold mb-6 text-center text-gray-800">Create Video from Images and Audio</h1>
      
      <div className="mb-6">
        <label className="block text-sm font-medium text-gray-700 mb-2">Default duration per image (seconds):</label>
        <div className="flex items-center gap-4">
          <input 
            type="range" 
            min="1" 
            max="10" 
            value={duration} 
            onChange={(e) => setDuration(parseInt(e.target.value))}
            className="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
          />
          <span className="w-12 text-center">{duration}s</span>
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        {/* Image Upload Section */}
        <div className="space-y-4">
          <div className="border-2 border-dashed border-gray-300 rounded-lg p-4">
            <label className="cursor-pointer flex flex-col items-center justify-center gap-2 p-4">
              <Upload className="w-8 h-8 text-gray-400" />
              <span className="text-sm font-medium text-gray-700">Upload Images</span>
              <input
                type="file"
                multiple
                accept="image/*"
                className="hidden"
                onChange={handleImageUpload}
              />
            </label>
          </div>

          {/* Image Previews */}
          <div className="space-y-3">
            {images.map((image, index) => (
              <div key={index} className="border rounded-lg p-3 flex items-start gap-3">
                <img 
                  src={image.preview} 
                  alt={`Preview ${index}`} 
                  className="w-16 h-16 object-cover rounded"
                />
                <div className="flex-1">
                  <div className="flex justify-between items-start">
                    <span className="text-sm font-medium truncate">{image.file.name}</span>
                    <button 
                      onClick={() => handleRemoveImage(index)}
                      className="text-red-500 hover:text-red-700"
                    >
                      <Trash2 size={16} />
                    </button>
                  </div>
                  
                  {editingIndex === index ? (
                    <div className="flex items-center gap-2 mt-2">
                      <input
                        type="number"
                        min="1"
                        max="10"
                        value={editDuration}
                        onChange={(e) => setEditDuration(parseInt(e.target.value))}
                        className="w-16 px-2 py-1 border rounded text-sm"
                      />
                      <span className="text-sm">seconds</span>
                      <button 
                        onClick={saveEditDuration}
                        className="text-green-500 hover:text-green-700"
                      >
                        <CheckCircle size={16} />
                      </button>
                    </div>
                  ) : (
                    <div className="flex items-center gap-2 mt-2">
                      <span className="text-sm">{image.duration} seconds</span>
                      <button 
                        onClick={() => startEditDuration(index)}
                        className="text-blue-500 hover:text-blue-700"
                      >
                        <Edit size={16} />
                      </button>
                    </div>
                  )}
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Audio Upload Section */}
        <div className="space-y-4">
          <div className="border-2 border-dashed border-gray-300 rounded-lg p-4">
            <label className="cursor-pointer flex flex-col items-center justify-center gap-2 p-4">
              <FilePlus className="w-8 h-8 text-gray-400" />
              <span className="text-sm font-medium text-gray-700">Upload Audio</span>
              <input
                type="file"
                accept="audio/*"
                className="hidden"
                onChange={handleAudioUpload}
              />
            </label>
          </div>

          {/* Audio Preview */}
          {audio && (
            <div className="border rounded-lg p-3 flex items-start gap-3">
              <div className="bg-gray-100 p-3 rounded-full">
                <FilePlus className="w-6 h-6 text-gray-500" />
              </div>
              <div className="flex-1">
                <div className="flex justify-between items-start">
                  <span className="text-sm font-medium truncate">{audio.name}</span>
                  <button 
                    onClick={handleRemoveAudio}
                    className="text-red-500 hover:text-red-700"
                  >
                    <Trash2 size={16} />
                  </button>
                </div>
                <audio 
                  src={audio.preview} 
                  controls 
                  className="w-full mt-2 h-8"
                />
              </div>
            </div>
          )}
        </div>
      </div>

      {/* Status Messages */}
      {error && (
        <div className="mb-4 p-3 bg-red-100 text-red-700 rounded flex items-center gap-2">
          <AlertCircle size={16} />
          <span>{error}</span>
        </div>
      )}
      {success && (
        <div className="mb-4 p-3 bg-green-100 text-green-700 rounded flex items-center gap-2">
          <CheckCircle size={16} />
          <span>{success}</span>
        </div>
      )}

      {/* Create Video Button */}
      <button
        type="button"
        onClick={createVideo}
        disabled={isLoading || images.length === 0 || !audio}
        className={`w-full py-3 rounded-md flex items-center justify-center gap-2 ${
          isLoading || images.length === 0 || !audio
            ? 'bg-gray-400 cursor-not-allowed'
            : 'bg-blue-600 hover:bg-blue-700'
        } text-white`}
      >
        {isLoading ? (
          <>
            <Loader2 className="animate-spin" size={18} />
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
        <div className="mt-6 space-y-3">
          <h2 className="text-lg font-medium">Your Video</h2>
          <div className="border rounded-lg overflow-hidden">
            <video
              ref={videoRef}
              controls
              src={videoUrl}
              className="w-full rounded-md"
            />
          </div>
          <a 
            href={videoUrl} 
            download="created-video.mp4"
            className="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"
          >
            <Download size={16} />
            <span>Download Video</span>
          </a>
        </div>
      )}
    </div>
  );
}