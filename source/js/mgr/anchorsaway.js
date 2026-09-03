var anchorsaway = function (config) {
    config = config || {};
    anchorsaway.superclass.constructor.call(this, config);
};
Ext.extend(anchorsaway, Ext.Component, {
    initComponent: function () {
        this.stores = {};
        this.ajax = new Ext.data.Connection({
            disableCaching: true,
        });
    }, page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, util: {}, form: {}
});
Ext.reg('anchorsaway', anchorsaway);

AnchorsAway = new anchorsaway();
