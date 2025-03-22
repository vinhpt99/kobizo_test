<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Panel</a>

        <!-- Nút Toggle khi màn hình nhỏ -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Danh sách menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link to="/post" class="nav-link">Post List</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/post/new" class="nav-link">Create Post</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/meta" class="nav-link">Meta List</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/meta/new" class="nav-link">Create Meta</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <router-view />
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
.navbar {
  margin-bottom: 20px;
}
</style>
