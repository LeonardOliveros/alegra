Ext.define('Alegra.view.contact.Grid' ,{
  extend: 'Ext.grid.Panel',
  alias: 'widget.contactGrid',
  requires: ['Ext.toolbar.Paging'],
  iconCls: 'icon-grid',
  title: 'Contactos',
  store: 'Contacts',
  columns: [{
    header: 'Nombre',
    width: 299,
    flex: 1,
    dataIndex: 'name',
    menuDisabled: true,
  }, {
    header: 'Identificación',
    width: 177,
    flex: 1,
    dataIndex: 'identification',
    menuDisabled: true,
  }, {
    header: 'Teléfono 1',
    width: 177,
    flex: 1,
    dataIndex: 'phonePrimary',
    menuDisabled: true,
  }, {
    header: 'Observaciones',
    width: 177,
    flex: 1,
    dataIndex: 'observations',
    menuDisabled: true,
  }],
  initComponent: function() {
    this.dockedItems = [{
      xtype: 'toolbar',
      items: [{
        iconCls: 'icon-save',
        text: 'Agregar',
        action: 'add'
      }, {
        iconCls: 'icon-delete',
        text: 'Eliminar',
        action: 'delete'
      }]
    }, {
      xtype: 'pagingtoolbar',
      dock: 'top',
      store: 'Contacts',
      displayInfo: true,
      displayMsg: 'Mostrando Contactos {0} - {1} de {2}',
      emptyMsg: "Ning\u00FAn contacto encontrado."
    }];
    this.callParent(arguments);
  }
});
