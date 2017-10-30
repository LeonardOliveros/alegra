Ext.define('Application.controller.ContactController',{
	extend: 'Ext.app.Controller',
	views: [
		'contact.Grid',
		'contact.Form',
		'contact.Show',
		'contact.FormAdd',
	],
	models: ['Contact'],
	stores: ['Contacts'],
	refs: [
		{
			ref: 'list',
			selector: 'contactGrid',
		},
	],
	init: function() {
		this.control({
			'contactGrid button[action=edit]': {
				click: this.edit
			},
			'contactGrid': {
				itemdblclick: this.edit
			},
			// 'contactGrid button[action=add]': {
			//		click: this.add
			//	},
			'contactGrid button[action=delete]': {
				click: this.destroy
			},
			'contactForm button[action=save]': {
				click: this.save
			},
			'formAdd button[action=add]': {
				click: this.add
			},
			'contactGrid button[action=show]': {
				click: this.show
			},
			'contactGrid button[action=showAdd]': {
				click: this.showAdd
			},
			'contactGrid actioncolumn[action=show]': {
				click: this.show
			}
		});
	},
	showAdd: function() {
		let view = Ext.create('Application.view.contact.FormAdd');
		view.setTitle('Nuevo contacto');
	},
	add: function(btn, e, eOpts) {
		//btn.disable();
		let form = btn.up('form').getForm();
		if (form.isValid()) {
			let getContactsStore = this.getContactsStore();
			let values = form.getValues();
			model = Ext.create('Application.model.Contact');
			model.set(values);
			getContactsStore.add(model);
			let response = getContactsStore.sync({
				success: function (batch, action) {
					let reader = batch.proxy.getReader();
					if (reader.jsonData.code !== "201") {
						return Ext.Msg.alert('Failed', reader.jsonData ? reader.jsonData.message : 'Error');
					}
					Ext.Msg.alert('Succsess', reader.jsonData.message, function() { location.href = '/index'; });
				},
				failure: function (batch, action) {
					let reader = batch.proxy.getReader();
					Ext.Msg.alert('Failed', reader.jsonData ? reader.jsonData.message : 'No response');
				}
			});
		} else {
			Ext.Msg.alert('Upss!', 'Debes verificar los campos marcados en rojo para continuar.');
		}
	},
	edit: function(btn, e, eOpts){
		let grid = btn.up('grid');
		let records = grid.getSelectionModel().getSelection();
		if (records.length === 1) {
			let record = records[0];
			let win = Ext.create('Application.view.contact.Form');
			let form = win.down('form');
			form.loadRecord(record);
		} else {
			Ext.Msg.alert('Upss!', 'No ha seleccionado ningun registro.');
		}
	},
	save: function(btn, e, eOpts) {
		btn.disable();
		let win = btn.up('window');
		let form = win.down('form');
		if (form.isValid()) {
			let values = form.getValues();
			let record = form.getRecord();
			let grid = Ext.ComponentQuery.query('contactGrid')[0];
			let store = grid.getStore();
			record.set(values);
			store.sync({
				success: function (batch, action) {
					let reader = batch.proxy.getReader();
					Ext.Msg.alert('Success', reader.jsonData.message == '' ? reader.jsonData.message : 'Contacto actualizado.');
					win.close();
				},
				failure: function (batch, action) {
					let reader = batch.proxy.getReader();
					Ext.Msg.alert('Failed', reader.jsonData ? reader.jsonData.message : 'No response');
				}
			});
		} else {
			Ext.Msg.alert('Upss!', 'Debes verificar los campos marcados en rojo para continuar.');
		}
	},
	destroy: function(btn, e, eOpts) {
		let grid = btn.up('grid');
		let records = grid.getSelectionModel().getSelection();
		let store = grid.getStore();
		let title = records.length > 1 ? 'Eliminar ' + records.length + ' clientes' : 'Eliminar cliente';
		let msg = records.length > 1 ? '¿Estás seguro de que deseas eliminar ' + records.length + ' clientes? Esta operación no se puede deshacer.' : '¿Estás seguro de que deseas eliminar el cliente? Esta operación no se puede deshacer';

		if (records.length === 0) {
			Ext.Msg.alert('Upss!', 'No ha seleccionado ningún cliente.');
		} else {
			Ext.Msg.show({
				title,
				msg,
				buttons: Ext.Msg.YESNOCANCEL,
				icon: Ext.MessageBox.QUESTION,
				scope: this,
				width: 600,
				fn: function(btn, ev){
					if (btn == 'yes') {
						store.remove(records);
						store.sync({
							success: function (batch, action) {
								let reader = batch.proxy.getReader();
								Ext.Msg.alert('Success', reader.jsonData.message );
							},
							failure: function (batch, action) {
								let reader = batch.proxy.getReader();
								Ext.Msg.alert('Failed', reader.jsonData ? reader.jsonData.message : 'No response');
							}
						});
					}
				}
			});
		}
	},
	show: function(btn, e, eOpts) {
		let grid = btn.up('grid');
		let records = grid.getSelectionModel().getSelection();
		if (records.length === 1) {
			let record = records[0];
			let win = Ext.create('Application.view.contact.Show');
			let form = win.down('form');
			form.loadRecord(record);
		} else {
			Ext.Msg.alert('Upss!', 'No puede seleccionar más de una línea');
		}
	},
});
