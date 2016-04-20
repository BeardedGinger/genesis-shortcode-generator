(function() {
	tinymce.PluginManager.add('genesis_shortcodes_additions', function( editor, url ) {
		editor.updateButton('genesis_shortcodes', {
			menu: [
				{
					text: 'Test',
					menu: [
						{
							text: 'Boogers',
							onclick: function() {
								editor.insertContent('[gb_clear]');
							}
						}
					]
				}
			]
		});
	});
}) ();