Ext.define('Application.model.Contact',{
  extend: 'Ext.data.Model',
	fields: [
    'id',
    'name',
    'identification',
    { name: 'address', mapping: 'address.address' },
    { name: 'city', mapping: 'address.city' },
    'email',
    'phonePrimary',
    'phoneSecondary',
    'fax',
    'mobile',
    'priceList',
    'seller',
    'term',
    'type',
    'observations',
    'balanceAdvances',
  ],
	idProperty: 'id'
});
