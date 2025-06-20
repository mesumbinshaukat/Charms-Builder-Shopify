new Vue({
  el: '#app',
  data: {
    step: 1,
    bases: [
      {id: 1, title: 'Silver Bracelet', image: 'base1.png', slots: 5},
      {id: 2, title: 'Gold Bracelet', image: 'base2.png', slots: 7}
    ],
    selectedBase: null,
    charms: [],
    slots: [],
    draggingCharm: null
  },
  computed: {
    hasCharms() {
      return this.slots.some(slot => slot);
    },
    totalPrice() {
      let basePrice = this.selectedBase ? 20 : 0;
      let charmsPrice = this.slots.reduce((sum, slot) => slot ? sum + parseFloat(slot.node.variants.edges[0].node.price) : sum, 0);
      return (basePrice + charmsPrice).toFixed(2);
    }
  },
  methods: {
    nextStep() {
      if (this.step === 1 && this.selectedBase) {
        this.slots = Array(this.selectedBase.slots).fill(null);
      }
      this.step++;
    },
    prevStep() {
      this.step--;
    },
    selectBase(base) {
      this.selectedBase = base;
    },
    dragCharm(charm) {
      this.draggingCharm = charm;
    },
    dropCharm(e) {
      let idx = this.slots.findIndex(slot => !slot);
      if (idx !== -1 && this.draggingCharm) {
        this.$set(this.slots, idx, this.draggingCharm);
        this.draggingCharm = null;
      }
    },
    removeCharm(i) {
      this.$set(this.slots, i, null);
    },
    reset() {
      this.step = 1;
      this.selectedBase = null;
      this.slots = [];
    }
  },
  mounted() {
    fetch('/api_charms.php')
      .then(res => res.json())
      .then(data => { this.charms = data; });
  }
}); 