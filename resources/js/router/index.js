import { createRouter, createWebHistory } from "vue-router";
import pagesHomeHeader from '../components/pages/home/index.vue'
import pagesHomeCoursedetail from '../components/pages/home/coursedetail.vue'
import pagesHomeQuiz from '../components/pages/home/quiz.vue'
import pagesHomeLogin from '../components/pages/home/login.vue'
import pagesHomeRegister from '../components/pages/home/register.vue'
import pagesHomesBook from '../components/pages/home/book.vue'
import pagesHomeBookDetail from '../components/pages/home/bookdetail.vue'
import pagesHomeChat from '../components/pages/home/chat.vue'


//admin
import pagesAdmin from '../components/pages/admin/dashboard.vue'
import pagesAdminLevel from '../components/pages/admin/level.vue'
import pagesAdminQuiz from '../components/pages/admin/quiz.vue'
import pagesAdminLearning from '../components/pages/admin/learning.vue'
import pagesAdminCategory from '../components/pages/admin/category.vue'
import pagesAdminBook from '../components/pages/admin/book.vue'
import pagesAdminChapter from '../components/pages/admin/chapter.vue'
import pagesAdminSubject from '../components/pages/admin/subject.vue'
import pagesAdminUser from '../components/pages/admin/user.vue'


import notFound from '../components/notFound.vue'




const routes = [
    {
        path: '/',
        name: 'Index',
        component: pagesHomeHeader,
        meta: {
            requiresAuth: false
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
        name: 'Chat',
        path: '/chat',
        component: pagesHomeChat,
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
            requiresAuth: true,
            requiresAdmin: true

        }

    },

    {
        name: 'quiz',
        path: '/admin/quiz',
        component: pagesAdminQuiz,
        meta: {
            requiresAuth: true,
            requiresAdmin: true

        }

    },

    {
        name: 'Learning',
        path: '/admin/learning',
        component: pagesAdminLearning,
        meta: {
            requiresAuth: true,
            requiresAdmin: true

        }

    },

    {
        name: 'Category',
        path: '/admin/category',
        component: pagesAdminCategory,
        meta: {
            requiresAuth: true,
            requiresAdmin: true

        }

    },

    {
        name: 'book',
        path: '/admin/book',
        component: pagesAdminBook,
        meta: {
            requiresAuth: true,
            requiresAdmin: true

        }

    },

    {
        name: 'Chapter',
        path: '/admin/chapter',
        component: pagesAdminChapter,
        meta: {
            requiresAuth: true,
            requiresAdmin: true

        }

    },
    {
        name: 'Dashboard',
        path: '/admin',
        component: pagesAdmin,
        meta: {
            requiresAuth: true,
            requiresAdmin: true

        }

    },

    {
        name: 'subject',
        path: '/admin/subject',
        component: pagesAdminSubject,
        meta: {
            requiresAuth: true,
            requiresAdmin: true

        }

    },
    {
        name: 'user',
        path: '/admin/user',
        component: pagesAdminUser,
        meta: {
            requiresAuth: true,
            requiresAdmin: true

        }

    },


    {
        name: 'NotFound',
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



// router.beforeEach((to, from, next) => {
//     const isAdmin = localStorage.getItem('user') && JSON.parse(localStorage.getItem('user')).admin;

//     if (to.meta.requiresAuth && !localStorage.getItem('token')) {
//         next({ name: 'Login' });
//     } else if (to.meta.requiresAdmin && !isAdmin) {
//         next({ name: 'Accès interdit' }); // Remplacez "Accès interdit" par le nom de votre composant/page d'erreur d'accès interdit
//     } else {
//         next();
//     }
// })


router.beforeEach(async (to, from, next) => {
    const isAuthenticated = localStorage.getItem('token');
    let isAdmin = false;

    if (to.meta.requiresAuth && !isAuthenticated) {
        next({ name: 'Login' });
    } else {
        try {
            const response = await axios.get('/api/user', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            });
            isAdmin = response.data.admin;
        } catch (error) {
            console.log(error);
        }

        if (to.meta.requiresAdmin && !isAdmin) {
            next({ name: 'NotFound' });
        } else {
            next();
        }
    }
});





export default router
