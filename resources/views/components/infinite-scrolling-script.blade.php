<div x-data="{
    init() {
        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    @this.call(@js($method))
                }
            })
        }, {
            root: null
        });
        observer.POLL_INTERVAL = 100
        observer.observe(this.$el);
    }
}" class="grid grid-cols-1 gap-8 mt-4 md:grid-cols-1 lg:grid-cols-1">
</div>
