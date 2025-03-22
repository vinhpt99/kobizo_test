<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <router-link to="/" class="navbar-brand">Home</router-link>
        <router-link to="/post/new" class="btn btn-primary">Create Post</router-link>
      </div>
    </nav>

    <div class="container mt-4">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  name: "App"
};
</script>