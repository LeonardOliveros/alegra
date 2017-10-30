/*Ext.Loader.setConfig(
	{ enabled: true },
);

Ext.application({
	name: 'Application',
	//appFolder : '/app',
	controllers: ['ContactController'],
	launch: function() {
		Ext.create('Application.view.contact.FormAdd',{
			renderTo: 'divApp',
			store: 'Contacts',
		});
	}
});*/

Ext.Loader.setConfig(
	{ enabled: true },
);

Ext.application({
	name: 'Application',
	// Automatically create an instance of AM.view.Viewport
	// on application launch
	autoCreateViewport: true,
	// Attach controllers
	controllers: ['ContactController'],
	/*launch: function() {
		let grid = Ext.create('Application.view.contact.Grid', {
			renderTo: 'contactList',
			store: 'Contacts',
			//title: 'Contactos',
		});
	},*/
});
