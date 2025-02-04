import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';


createInertiaApp({
  resolve: async (name) => {
    const pages = import.meta.glob('./Pages/**/*.jsx');
    return pages[`./Pages/${name}.jsx`]();
  },
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />);
  },
});
