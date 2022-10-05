window.addEventListener( 'elementor/init', () => {

	var taxoSelect = elementor.modules.controls.BaseData.extend({
        onReady() {
            this.control_select =  this.$el.find('.post-select');
            this.save_input =   this.$el.find('.post-save-value');
        },

        saveValue() {
            
		},
		onBeforeDestroy() {
            this.saveValue();
		}
    });

    elementor.addControlView( 'test-control-select', testselect );


} );