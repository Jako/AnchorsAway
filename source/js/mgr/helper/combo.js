AnchorsAway.combo.Boolean = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        mode: 'local',
        store: new Ext.data.SimpleStore({
            fields: ['display', 'value'],
            data: [
                [_('yes'), '1'],
                [_('no'), '0']
            ]
        }),
        fields: ['value', 'display'],
        hiddenName: config.name || 'field',
        paging: false,
        valueField: 'value',
        displayField: 'display'
    });
    AnchorsAway.combo.Boolean.superclass.constructor.call(this, config);
};
Ext.extend(AnchorsAway.combo.Boolean, MODx.combo.ComboBox);
Ext.reg('anchorsaway-combo-boolean', AnchorsAway.combo.Boolean);
