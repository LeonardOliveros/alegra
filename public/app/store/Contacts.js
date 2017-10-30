Ext.define('Application.store.Contacts',{
	extend: 'Ext.data.Store',
	autoLoad: true,
	autoSync: false,
	storeId: 'Contacts',
	leadingBufferZone: 10,
	pageSize: 20,
	model: 'Application.model.Contact',
	proxy: {
		type: 'ajax',
		api: {
			read: 'api/index',
			create: 'api/create',
			update: 'api/update',
			destroy: 'api/delete',
		},
		actionMethods: {
			read: 'GET',
			create: 'POST',
			update: 'POST',
			destroy: 'POST',
		},
		headers: {
			'Content-Type': 'application/json',
		},
		reader: {
			type: 'json',
			root: 'data',
			rootProperty: 'data',
			successProperty: 'success',
			messageProperty: 'message',
			totalProperty: 'total',
		},
		writer: {
			type: 'json',
			writeAllFields: true,
			root: 'data',
			encode: true,
		},
	},
});
