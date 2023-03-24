module.exports = {
    content: [
        './public/**/*.php',
        './src/View/**/*.php',
        './node_modules/flowbite/**/*.js'
    ],
    theme: {
        fontFamily: {
            'sans': ['Inter', 'sans-serif']
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin')
    ]
}
