import collections from '@/views/Collections/list.vue'
import posts from '@views/Collections/posts.vue'

export default [
    {
        path: '/collections',
        name: 'collections',
        component: collections
    },
    {
        path: '/collections/:slug/posts',
        name: 'collections_posts',
        component: posts
    }
]