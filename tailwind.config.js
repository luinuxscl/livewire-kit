import { join } from 'path';
import daisyui from 'daisyui';

export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/css/**/*.css',
        './vendor/livewire/flux/**/*.php',
        './vendor/power-components/livewire-powergrid/**/*.php',
        './vendor/luinuxscl/promptpress/resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [
        daisyui,
    ],
};
