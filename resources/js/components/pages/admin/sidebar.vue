<script setup>
import { useRoute } from 'vue-router';
import router from "./../../../router/index.js";

    const $route = useRoute();

    const logout = () => {
    localStorage.removeItem("token");
    router.push("/login");
};

</script>

<template>
    <div class="col-xl-3">
        <!-- Responsive offcanvas body START -->
        <div
            class="offcanvas-xl offcanvas-end"
            tabindex="-1"
            id="offcanvasSidebar"
        >
            <!-- Offcanvas header -->
            <div class="offcanvas-header bg-light">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                    My profile
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="offcanvas"
                    data-bs-target="#offcanvasSidebar"
                    aria-label="Close"
                ></button>
            </div>
            <!-- Offcanvas body -->
            <div class="offcanvas-body p-3 p-xl-0">
                <div class="bg-dark border rounded-3 pb-0 p-3 w-100">
                    <!-- Dashboard menu -->
                    <div
                        class="list-group list-group-dark list-group-borderless"
                    >
                        <router-link :class="{ 'list-group-item': true, 'active': $route.path === '/admin' }" to="/admin"
                            ><i class="bi bi-ui-checks-grid fa-fw me-2"></i>
                            Dashboard
                        </router-link>
                        <router-link :class="{ 'list-group-item': true, 'active': $route.path === '/admin/chapter' }" to="/admin/chapter"
                            ><i class="bi bi-basket fa-fw me-2"></i
                            >chapter</router-link
                        >
                        <router-link
                            :class="{ 'list-group-item': true, 'active': $route.path === '/admin/quiz' }"
                            to="/admin/quiz"
                            ><i class="bi bi-question-diamond fa-fw me-2"></i
                            >Quiz</router-link
                        >
                        <router-link
                            :class="{ 'list-group-item': true, 'active': $route.path === '/admin/learning' }"
                            to="/admin/learning"
                            ><i class="bi bi-graph-up fa-fw me-2"></i
                            >Learnings</router-link
                        >
                        <router-link :class="{ 'list-group-item': true, 'active': $route.path === '/admin/level' }" to="/admin/level"
                            ><i class="bi bi-people fa-fw me-2"></i
                            >Level</router-link
                        >
                        <router-link :class="{ 'list-group-item': true, 'active': $route.path === '/admin/subject' }" to="/admin/subject"
                            ><i class="bi bi-people fa-fw me-2"></i
                            >Subject</router-link
                        >
                        <router-link :class="{ 'list-group-item': true, 'active': $route.path === '/admin/book' }" to="/admin/book"
                            ><i class="bi bi-folder-check fa-fw me-2"></i
                            >Book</router-link
                        >
                        <router-link
                            :class="{ 'list-group-item': true, 'active': $route.path === '/admin/category' }"
                            to="/admin/category"
                            ><i class="bi bi-star fa-fw me-2"></i
                            >Category</router-link
                        >
                        <router-link
                            :class="{ 'list-group-item': true, 'active': $route.path === '/admin/user' }"
                            to="/admin/user"
                            ><i class="bi bi-star fa-fw me-2"></i
                            >Users</router-link
                        >
                        <button
                            class="list-group-item text-danger bg-danger-soft-hover"
                            @click="logout()"
                            ><i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign
                            Out</button
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Responsive offcanvas body END -->
</template>
