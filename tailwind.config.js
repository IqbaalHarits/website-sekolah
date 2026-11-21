import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/**
 * Palette tokens live in resources/css/app.css as CSS variables (RGB channels),
 * so they can be reused by Filament and support opacity modifiers (bg-sand/20).
 */
const token = (name) => `rgb(var(--color-${name}) / <alpha-value>)`;

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './app/**/*.php',
    ],

    theme: {
        extend: {
            colors: {
                // Primary — Sand, diambil dari warna dinding gedung (#D6B07D)
                sand: {
                    50: '#FBF7F0',
                    100: '#F5ECDD',
                    200: '#EBDABF',
                    300: '#E0C79F',
                    400: '#DBBC8E',
                    DEFAULT: token('sand'), // #D6B07D
                    600: '#B98F5C',
                    700: '#946F46',
                    800: '#71553A',
                    900: '#54402F',
                },
                // Backgrounds
                cream: token('cream'), // #FBF7F0 — background utama
                beige: token('beige'), // #F2E8D8 — background sekunder
                // Accent / CTA — cokelat tua kolom & kayu gedung (#5C3A21)
                espresso: {
                    50: '#F7F1EC',
                    100: '#EBDDD1',
                    200: '#D3B9A3',
                    300: '#B08E6F',
                    400: '#8A6444',
                    500: '#714A2D',
                    DEFAULT: token('espresso'), // #5C3A21
                    700: '#4A2F1B',
                    800: '#3A2515',
                    900: '#2A1B10',
                },
                // Teks utama (#2E2219)
                ink: token('ink'),
            },

            fontFamily: {
                // Display serif for headings, humanist sans for body
                display: ['Fraunces', ...defaultTheme.fontFamily.serif],
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },

            fontSize: {
                // Fluid display sizes used by hero & section headings
                'display-lg': ['clamp(2.5rem, 5vw + 1rem, 4.75rem)', { lineHeight: '1.04', letterSpacing: '-0.025em' }],
                'display-md': ['clamp(2rem, 3vw + 1rem, 3.25rem)', { lineHeight: '1.1', letterSpacing: '-0.02em' }],
                'display-sm': ['clamp(1.5rem, 1.5vw + 1rem, 2.125rem)', { lineHeight: '1.2', letterSpacing: '-0.015em' }],
            },

            maxWidth: {
                prose: '68ch',
                shell: '76rem',
            },

            boxShadow: {
                card: '0 1px 0 rgb(92 58 33 / 0.04), 0 12px 32px -16px rgb(92 58 33 / 0.18)',
                'card-hover': '0 1px 0 rgb(92 58 33 / 0.04), 0 20px 44px -18px rgb(92 58 33 / 0.28)',
            },

            borderRadius: {
                card: '1.25rem',
            },

            transitionTimingFunction: {
                'out-expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
            },

            keyframes: {
                'fade-up': {
                    '0%': { opacity: '0', transform: 'translateY(14px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
            animation: {
                'fade-up': 'fade-up 0.7s cubic-bezier(0.16, 1, 0.3, 1) both',
            },

            typography: () => ({
                // `prose` styles for rich-text content (pages & posts)
                DEFAULT: {
                    css: {
                        '--tw-prose-body': 'rgb(var(--color-ink) / 0.86)',
                        '--tw-prose-headings': 'rgb(var(--color-espresso))',
                        '--tw-prose-lead': 'rgb(var(--color-ink) / 0.75)',
                        '--tw-prose-links': 'rgb(var(--color-espresso))',
                        '--tw-prose-bold': 'rgb(var(--color-ink))',
                        '--tw-prose-counters': 'rgb(var(--color-espresso))',
                        '--tw-prose-bullets': 'rgb(var(--color-sand))',
                        '--tw-prose-hr': 'rgb(var(--color-sand) / 0.4)',
                        '--tw-prose-quotes': 'rgb(var(--color-espresso))',
                        '--tw-prose-quote-borders': 'rgb(var(--color-sand))',
                        '--tw-prose-captions': 'rgb(var(--color-ink) / 0.6)',
                        '--tw-prose-th-borders': 'rgb(var(--color-sand))',
                        '--tw-prose-td-borders': 'rgb(var(--color-sand) / 0.4)',
                        fontFamily: '"Plus Jakarta Sans", ui-sans-serif, system-ui, sans-serif',
                        'h1, h2, h3, h4': { fontFamily: 'Fraunces, ui-serif, Georgia, serif', fontWeight: '600' },
                        a: { textDecorationColor: 'rgb(var(--color-sand))', textUnderlineOffset: '3px' },
                        blockquote: { fontFamily: 'Fraunces, ui-serif, Georgia, serif', fontStyle: 'normal' },
                    },
                },
            }),
        },
    },

    plugins: [forms, typography],
};
