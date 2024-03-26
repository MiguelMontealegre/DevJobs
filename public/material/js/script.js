Vue.config.devtools = true;

Vue.component('card', {
  template: `
    <div class="card-wrapoo"
      @mousemove="handleMouseMoverr"
      @mouseenter="handleMouseEnteroo"
      @mouseleave="handleMouseLeavedd"
      ref="cardifc">
      <div class="cardoo"
        :style="cardStyleeesi">
        <div class="card-bgoo" :style="[cardBgTransform, cardBgImage]"></div>
        <div class="card-informi">
          <slot name="headeroo"></slot>
          <slot name="contentoo"></slot>
        </div>
      </div>
    </div>`,
  mounted() {
    this.width = this.$refs.cardifc.offsetWidth;
    this.height = this.$refs.cardifc.offsetHeight;
  },
  props: ['dataImage'],
  data: () => ({
    width: 0,
    height: 0,
    mouseX: 0,
    mouseY: 0,
    mouseLeaveDelay: null }),

  computed: {
    mousePX() {
      return this.mouseX / this.width;
    },
    mousePY() {
      return this.mouseY / this.height;
    },
    cardStyleeesi() {
      const rXxx = this.mousePX * 30;
      const rYyy = this.mousePY * -30;
      return {
        transform: `rotateY(${rXxx}deg) rotateX(${rYyy}deg)` };

    },
    cardBgTransform() {
      const tXxx = this.mousePX * -40;
      const tYyy = this.mousePY * -40;
      return {
        transform: `translateX(${tXxx}px) translateY(${tYyy}px)` };

    },
    cardBgImage() {
      return {
        backgroundImage: `url(${this.dataImage})` };

    } },

  methods: {
    handleMouseMoverr(e) {
      this.mouseX = e.pageX - this.$refs.cardifc.offsetLeft - this.width / 2;
      this.mouseY = e.pageY - this.$refs.cardifc.offsetTop - this.height / 2;
    },
    handleMouseEnteroo() {
      clearTimeout(this.mouseLeaveDelay);
    },
    handleMouseLeavedd() {
      this.mouseLeaveDelay = setTimeout(() => {
        this.mouseX = 0;
        this.mouseY = 0;
      }, 1000);
    } } });



const app22 = new Vue({
  el: '#app22' });