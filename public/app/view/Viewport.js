Ext.define('Application.view.Viewport', {
  extend: 'Ext.container.Viewport',
  layout: {
    type: 'vbox',
    align: 'stretch',
    pack: 'start',
  },
  autoScroll: false,
  maxHeight: 510,
  items :  [
    {
      xtype: 'contactGrid',
      flex: 1,
    },
  ],
});
