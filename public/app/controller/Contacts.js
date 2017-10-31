Ext.define('Alegra.controller.Contacts', {
  extend: 'Ext.app.Controller',
  stores: ['Contacts'],
  models: ['Contact'],
  views: ['contact.Form', 'contact.Grid'],
  refs: [{
    ref: 'contactPanel',
    selector: 'panel',
  }, {
    ref: 'contactGrid',
    selector: 'grid',
  }],
  init: function() {
    this.control({
      'contactGrid dataview': {
        itemdblclick: this.editContact,
      },
      'contactGrid button[action=add]': {
        click: this.editContact,
      },
      'contactGrid button[action=delete]': {
        click: this.destroyContact,
      },
      'contactForm button[action=save]': {
        click: this.updateContact,
      },
    });
  },
  editContact: function(p_grid, p_record) {
    let v_editar = Ext.create('Alegra.view.contact.Form').show();
    // Si se edita un record.
    if (p_record.stores != null) {
      v_editar.down('form').loadRecord(p_record);
    }
  },
  updateContact: function(p_button) {
    let v_win = p_button.up('window');
    let v_form   = v_win.down('form');
    let v_record = v_form.getRecord();
    let v_values = v_form.getValues();
    let v_nuevo = false;

		if (v_values.id > 0) {
			v_record.set(v_values);
		} else {
			v_record = Ext.create('Alegra.model.Contact');
			v_record.set(v_values);
			this.getContactsStore().add(v_record);
			v_nuevo = true;
		}

		v_win.close();
    this.getContactsStore().sync();

    if (v_nuevo){
      // Cargar de nuevo el store.
      this.getContactsStore().load();
    }
  },
  destroyContact: function(p_button) {
    var v_grid = this.getContactGrid();
    var v_record = v_grid.getSelectionModel().getSelection();
    var v_store = this.getContactsStore();

    v_store.remove(v_record);
	  this.getContactsStore().sync();

    // Cargar de nuevo el store.
    this.getContactsStore().load();
  }
});
