<template>
  <div class="container py-5" style="max-width: 650px;">
    <div class="card shadow-sm border-0 rounded-lg">
      <div class="card-header bg-black text-white text-center py-3">
        <h3 class="mb-0 fw-bold">Dockerized Todo List 📝</h3>
        <small class="text-white-50">Laravel 13 API + Vue 3</small>
      </div>

      <div class="card-body p-4">
        <!-- Add Todo Input Form -->
        <form @submit.prevent="addTodo" class="mb-4">
          <div class="input-group input-group-lg">
            <input 
              v-model="newTodoTitle" 
              type="text" 
              class="form-control" 
              placeholder="Add new Task..." 
              :disabled="loading"
            >
            <button class="btn btn-primary px-4" type="submit" :disabled="loading || !newTodoTitle.trim()">
              <span v-if="loading" class="spinner-border spinner-border-sm me-1"></span>
              Add Task
            </button>
          </div>
        </form>

        <!-- Loading Indicator -->
        <div v-if="fetching" class="text-center py-4">
          <div class="spinner-border text-primary" role="status"></div>
          <p class="mt-2 text-muted">Todo list loading ...</p>
        </div>

        <!-- Empty State -->
        <div v-else-if="todos.length === 0" class="text-center text-muted py-4">
          <p class="lead mb-0">There is no task. Create new Task!</p>
        </div>

        <!-- Todo List -->
        <ul v-else class="list-group list-group-flush">
          <li 
            v-for="todo in todos" 
            :key="todo.id" 
            class="list-group-item d-flex justify-content-between align-items-center py-3 px-2 border-bottom"
          >
            <div class="form-check d-flex align-items-center mb-0">
              <input 
                class="form-check-input me-3 fs-5 cursor-pointer" 
                type="checkbox" 
                :checked="todo.is_completed" 
                @change="toggleTodo(todo)"
              >
              <span 
                class="fs-5" 
                :class="{ 'text-decoration-line-through text-muted': todo.is_completed }"
              >
                {{ todo.title }}
              </span>
            </div>

            <button 
              @click="deleteTodo(todo.id)" 
              class="btn btn-outline-danger btn-sm rounded-pill px-3"
              title="Delete Task"
            >
              Delete 🗑️
            </button>
          </li>
        </ul>
      </div>

      <div class="card-footer bg-light text-center py-2 text-muted small">
        Total Tasks: {{ todos.length }} | Completed: {{ completedCount }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

const todos = ref([]);
const newTodoTitle = ref('');
const loading = ref(false);
const fetching = ref(true);

// API Base URL
const API_URL = '/api/todos';

// 1. Fetch All Todos (Read)
const fetchTodos = async () => {
  try {
    const response = await axios.get(API_URL);
    todos.value = response.data.data;
  } catch (error) {
    console.error('Fetch error:', error);
  } finally {
    fetching.value = false;
  }
};

// 2. Add New Todo (Create)
const addTodo = async () => {
  if (!newTodoTitle.value.trim()) return;
  loading.value = true;
  try {
    const response = await axios.post(API_URL, { title: newTodoTitle.value });
    todos.value.unshift(response.data.data);
    newTodoTitle.value = '';
  } catch (error) {
    console.error('Add error:', error);
  } finally {
    loading.value = false;
  }
};

// 3. Toggle Complete Status (Update)
const toggleTodo = async (todo) => {
  try {
    const response = await axios.put(`${API_URL}/${todo.id}`);
    todo.is_completed = response.data.data.is_completed;
  } catch (error) {
    console.error('Toggle error:', error);
  }
};

// 4. Delete Todo (Delete)
const deleteTodo = async (id) => {
  try {
    await axios.delete(`${API_URL}/${id}`);
    todos.value = todos.value.filter(t => t.id !== id);
  } catch (error) {
    console.error('Delete error:', error);
  }
};

// Computed property for completed count
const completedCount = computed(() => {
  return todos.value.filter(t => t.is_completed).length;
});

// Lifecycle hook: Load data on mount
onMounted(() => {
  fetchTodos();
});
</script>

<style scoped>
.cursor-pointer {
  cursor: pointer;
}
</style>