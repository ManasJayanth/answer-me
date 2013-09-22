require.config({
	'paths': {
		'jquery': 'lib/jquery',
		'bootstrap': 'lib/bootstrap',
		'ajaxcreatetest': 'ajax',
		'createtest': 'createtest'
	},
	shim: {
		'bootstrap': {
			deps: ['jquery'],
		},
		'ajaxcreatetest': {
			deps: ['jquery'],
		},
		'createtest': {
			deps: ['jquery'],
		}
	}
});

require([
    'jquery', 'bootstrap','ajaxcreatetest','createtest'
], function(jquery,bootstrap,ajaxcreatetest,createtest) {
    console.log('createtest.html js dependencies loaded');
})