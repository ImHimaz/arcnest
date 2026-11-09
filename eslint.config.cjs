const defaultConfig = require( '@wordpress/scripts/config/eslint.config.cjs' );

module.exports = [
	...defaultConfig,
	{
		rules: {
			// Destructured params are already typed by TypeScript; don't demand a @param per property.
			'jsdoc/require-param': [ 'error', { checkDestructured: false } ],
			'jsdoc/check-param-names': [ 'error', { checkDestructured: false } ],
		},
	},
	{
		// Test tooling is a dev dependency of the repo.
		files: [ '**/test/**', '**/tests/**', '**/*.test.*', '**/*.spec.*' ],
		rules: {
			'import/no-extraneous-dependencies': 'off',
		},
	},
	{
		// Node CLI scripts report progress on the console.
		files: [ 'scripts/**' ],
		rules: {
			'no-console': 'off',
		},
	},
];
