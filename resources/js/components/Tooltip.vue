<template>
  <VDropdown
    :triggers="triggers"
    :distance="distance"
    :skidding="skidding"
    :placement="placement"
    :boundary="boundary"
    :prevent-overflow="preventOverflow"
    :handle-resize="true"
    :theme="theme"
    @show="$emit('tooltip-show')"
    @hide="$emit('tooltip-hide')"
  >
    <span>
      <slot />
    </span>

    <template #popper>
      <slot name="content"></slot>
    </template>
  </VDropdown>
</template>

<script>
import { PopperWrapper } from 'floating-vue'

export default {
  ...PopperWrapper,

  emits: ['tooltip-show', 'tooltip-hide'],

  props: {
    distance: {
      type: Number,
      default: 0,
    },

    skidding: {
      type: Number,
      default: 3,
    },

    triggers: {
      type: Array,
      default: ['hover'],
    },

    placement: {
      type: String,
      default: 'top',
    },

    boundary: {
      type: String,
      default: 'window',
    },

    preventOverflow: {
      type: Boolean,
      default: true,
    },

    theme: {
      type: String,
      default: 'Nova',
    },
  },
}
</script>
