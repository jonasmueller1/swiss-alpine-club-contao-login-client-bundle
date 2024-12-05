const Encore = require('@symfony/webpack-encore');

Encore
	.setOutputPath('public/')
	.setPublicPath('/bundles/markocupicswissalpineclubcontaologinclient')
	.setManifestKeyPrefix('')

    //.addEntry('backend', './assets/backend.js')
	//.addEntry('frontend', './assets/frontend.js')

	.copyFiles({
		from: './assets/styles',
		to: 'styles/[path][name].[hash:8].[ext]',
        pattern: /(\.css)$/,
    })
	.copyFiles({
		from: './assets/js',
		to: 'js/[path][name].[hash:8].[ext]',
	})
	.copyFiles({
		from: './assets/img',
		to: 'img/[path][name].[ext]',
	})

	.disableSingleRuntimeChunk()
	.cleanupOutputBeforeBuild()
	.enableSourceMaps()
	.enableVersioning()

	// enables @babel/preset-env polyfills
	.configureBabelPresetEnv((config) => {
		config.useBuiltIns = 'usage';
		config.corejs = 3;
	})

	.enablePostCssLoader()
;

module.exports = Encore.getWebpackConfig();
