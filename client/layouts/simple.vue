<template>
  <div class="simple-layout d-flex align-items-center justify-content-center m-0 bg-white">
    <nuxt />
  </div>
</template>

<style lang="scss">
.simple-layout {
  color: #636b6f;
  height: 100vh;
  font-weight: 100;
  position: relative;

  .links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
  }
}
</style>
