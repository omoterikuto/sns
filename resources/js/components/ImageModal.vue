<template>
  <div>
    <div>
      <a @click="openModal">
        <img class="rounded-circle" :src="'/storage/' + ImagePass " width="60px" height="60px" />
      </a>
    </div>
    <transition name="modal">
      <div @click="closeModal" v-if="modal" class="modal-overlay">
        <img :src="'/storage/' + ImagePass " width="80%" style="position: absolute;" />
      </div>
    </transition>
  </div>
</template>
<script>
export default {
  props: {
    ImagePass: String
  },
  data() {
    return {
      modal: false
    };
  },
  methods: {
    openModal() {
      this.modal = true;
    },
    closeModal() {
      this.modal = false;
    }
  }
};
</script>

<style>
.modal-overlay {
  display: flex;
  align-items: center;
  justify-content: center;
  position: fixed;
  z-index: 30;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  transition: opacity 0.4s ease;
}

.modal-enter,
.modal-leave-to {
  opacity: 0;
}
</style>