import { createRouter, createWebHistory } from "vue-router";
import pagesHomeHeader from '../components/pages/home/index.vue'
import pagesHomeCoursedetail from '../components/pages/home/coursedetail.vue'
import pagesHomeQuiz from '../components/pages/home/quiz.vue'
import pagesHomeLogin from '../components/pages/home/login.vue'
import pagesHomeRegister from '../components/pages/home/register.vue'
import pagesHomesBook from '../components/pages/home/book.vue'
import pagesHomeBookDetail from '../components/pages/home/bookdetail.vue'

//admin
import pagesAdminLevel from '../components/pages/admin/level.vue'


import notFound from '../components/notFound.vue'




const routes = [
    {
        path: '/index',
        name: 'Index',
        component: pagesHomeHeader,
        meta: {
            requiresAuth: true
        }
    },

    {
        name: 'Detailducours',
        path: '/detailducours/:name',
        component: pagesHomeCoursedetail,
        props: true,
        meta: {
            requiresAuth: true
        }
    },

    {
        name: 'Quiz',
        path: '/quiz/:nameChapter',
        component: pagesHomeQuiz,
        props: true,
        meta: {
            requiresAuth: true
        }

    },

    {
        name: 'Login',
        path: '/login',
        component: pagesHomeLogin,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'Register',
        path: '/register',
        component: pagesHomeRegister,
        meta: {
            requiresAuth: false
        }

    },

    {
        name: 'Book',
        path: '/library',
        component: pagesHomesBook,
        meta: {
            requiresAuth: true
        }

    },

    {
        name: 'BookDetail',
        path: '/library/:bookName',
        component: pagesHomeBookDetail,
        props: true,
        meta: {
            requiresAuth: true
        }

    },

//admin
    {
        name: 'Level',
        path: '/admin/level',
        component: pagesAdminLevel,
        meta: {
            requiresAuth: true
        }

    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound,
        meta: {
            requiresAuth: false
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes

})

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        return { name: 'Login' }
    }

    if (to.meta.requiresAuth == false && localStorage.getItem('token')) {
        return { name: 'Detailducours' }
    }
})


export default router
