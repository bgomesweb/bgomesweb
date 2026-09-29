<script setup lang="ts">
import { computed } from 'vue'

const phoneNumber = import.meta.env.VITE_WHATSAPP_NUMBER ?? '5519998970090'
const defaultMessage =
  import.meta.env.VITE_WHATSAPP_MESSAGE ??
  'Olá Bruno! Vi seu portfólio e gostaria de conversar sobre uma oportunidade.'

const whatsappUrl = computed(() => {
  const encodedMessage = encodeURIComponent(defaultMessage)
  return `https://wa.me/${phoneNumber}?text=${encodedMessage}`
})
</script>

<template>
  <a
    :href="whatsappUrl"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Conversar no WhatsApp"
    class="group fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] shadow-lg shadow-black/40 transition-transform hover:scale-110 focus:outline-none focus-visible:ring-4 focus-visible:ring-[#25D366]/40 sm:h-16 sm:w-16"
  >
    <span
      class="absolute inline-flex h-full w-full animate-ping rounded-full bg-[#25D366] opacity-40 group-hover:opacity-60"
    ></span>
    <svg
      viewBox="0 0 32 32"
      class="relative h-7 w-7 fill-white sm:h-8 sm:w-8"
      aria-hidden="true"
    >
      <path
        d="M16.004 3C9.377 3 4 8.373 4 15c0 2.397.702 4.63 1.912 6.508L4.06 29l7.66-1.822A11.94 11.94 0 0 0 16.004 27C22.63 27 28 21.627 28 15S22.63 3 16.004 3Zm0 21.75a9.7 9.7 0 0 1-4.955-1.36l-.356-.21-4.545 1.081 1.114-4.43-.232-.372A9.67 9.67 0 0 1 5.75 15c0-5.66 4.594-10.25 10.254-10.25S26.25 9.34 26.25 15 20.658 24.75 16.004 24.75Zm5.63-7.66c-.308-.154-1.82-.898-2.102-1.001-.282-.103-.487-.154-.693.155-.205.308-.795 1-0.975 1.207-.18.205-.36.231-.667.077-.308-.154-1.298-.478-2.472-1.522-.914-.815-1.53-1.822-1.71-2.13-.18-.308-.02-.475.135-.628.138-.138.308-.36.462-.54.154-.18.205-.308.308-.514.103-.205.051-.386-.026-.54-.077-.154-.693-1.669-.949-2.284-.25-.6-.505-.519-.693-.529l-.59-.01c-.205 0-.54.077-.822.386-.282.308-1.078 1.052-1.078 2.567s1.104 2.978 1.258 3.183c.154.205 2.174 3.32 5.267 4.657.736.318 1.31.508 1.758.65.738.235 1.41.202 1.941.123.592-.089 1.82-.744 2.077-1.463.257-.72.257-1.336.18-1.464-.077-.128-.282-.205-.59-.36Z"
      />
    </svg>
  </a>
</template>
