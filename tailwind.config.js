module.exports = {
    content: [
        './public/**/*.php',
        './src/View/**/*.php',
        './node_modules/flowbite/**/*.js'
    ],
    theme: {
        fontFamily: {
            'sans': ['Inter', 'sans-serif']
        },
        backgroundImage: {
            'hero-header': "url('/assets/hero-bgArtboard 1@2x.png')",
			'bicc-logo': "url('/assets/bicc-logo@2x.png')",
			'bicc-masthead': "url('/assets/infiniti-masthead.png')"
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin')
    ]
}
