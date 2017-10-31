Ext.define('Alegra.view.Viewport', {
	extend: 'Ext.Viewport',
	layout: 'fit',
	requires: [
		'Alegra.view.contact.Grid',
		'Alegra.view.contact.Form',
	],
	initComponent: function() {
		var me = this;
		Ext.apply(me, {
			items: [{
				xtype : 'contactGrid',
			}],
		});
		me.callParent(arguments);
	},
});
