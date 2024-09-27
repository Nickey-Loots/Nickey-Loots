const primary_color = '#54B880';
const primary_color_light = '#54B880';
const primary_color_dark = '#0D8549';
const secondary_color = "#b88054";
const base_color = '#fffff0';
const brand_color = '#ffdb01;'

const heading_color = '#302b28';

const fontstack_sans_serif = ['Montserrat', 'sans-serif'];

tailwind.config = {
    theme: {
        extend: {
            colors: {
                'primary': primary_color,
                'primary-dark': primary_color_dark,
                'secondary': secondary_color,
                'heading': heading_color,
                'base': base_color,
                'brand': brand_color,
            },
            fontFamily: {
                'sans-serif': fontstack_sans_serif,
            },
            content: {
                'sprite': 'url("./media/logos/Lokaal 050 Graanspriet.svg")',
                'hero': 'url("./media/dd-fotos/hero.jpeg")'
              },
              scale: {
                '-100': '-1',
            }
            }

        }
    }

