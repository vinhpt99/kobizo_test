<template>
  <div class="container">
    <div v-if="isLoading" class="loading-container">
      <span class="spinner-border text-primary" role="status"></span>
      <p>Loading...</p>
    </div>

    <nav v-else-if="isAuthenticated" class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
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
            <li class="nav-item" style="display: flex; align-items: center;">
              <a href="/rss-reader">Rss Reader</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <router-view />
  </div>
</template>

<script>
import apiClient from './auth';

export default {
  name: "App",
  data() {
    return {
      isAuthenticated: false,
      isLoading: true, // Thêm trạng thái loading
    };
  },
  async mounted() {
    await this.checkAuth();
  },
  methods: {
    async checkAuth() {
      try {
        await apiClient.get("/check-auth");
        this.isAuthenticated = true;
      } catch (error) {
        this.isAuthenticated = false;
      } finally {
        this.isLoading = false;
      }
    },
  },
};
</script>

<style>
.navbar {
  margin-bottom: 20px;
}

.loading-container {
  text-align: center;
  margin-top: 50px;
}

.spinner-border {
  width: 3rem;
  height: 3rem;
}
</style>
