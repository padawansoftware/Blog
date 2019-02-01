import list from '@/views/Posts/list.vue'
import post from '@/views/Posts/post.vue'

export default [
    {
        path: '/posts',
        name: 'posts',
        component: list
    },
    {
        path: '/posts/:slug',
        name: 'post',
        component: post
    }
]