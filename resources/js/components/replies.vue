<template>
    <div>
        <!-- <div class="form-inline my-4 w-full">
            <input type="text" class="form-control form-control-sm w-80">
            <button class="btn btn-sm btn-primary">
                <small>Add reply</small>
            </button>
        </div> -->
        <div class="media my-3" v-for="reply in replies.data">
            <a v-if ="reply.user"  class="mr-3" href="#">
                <avatar  :username="reply.user.name" class='mr-3' :size="30"></avatar>
            </a>
            <div class="media-body">

                
                <h6 v-if ="reply.user" class="mt-0">
                    {{ reply.user.name }} 
                </h6> 
               
                <small >
                    {{ reply.body }}
                </small>

                <votes v-if ="reply.user" :default_votes="reply.votes" :entity_id="reply.id" :entity_owner="reply.user.id"></votes>
            </div>
        </div>

        <div v-if="comment.repliesCount > 0 && replies.next_page_url" class="text-center">
            <button @click="fetchReplies" class="btn btn-info btn-sm">Load Replies</button>
        </div>
    </div>
</template>

<script>
    import Avatar from 'vue-avatar'
    export default {
        props: ['comment'],
        components: {
            Avatar
        },
        data() {
            return {
                replies: {
                    data: [],
                    next_page_url: `/comments/${this.comment.id}/replies`
                }
            }
        },
        methods: {
            fetchReplies() {
                axios.get(this.replies.next_page_url).then(({ data }) => {
                    this.replies = {
                        ...data,
                        data: [
                            ...this.replies.data,
                            ...data.data
                        ]
                    }
                })
            },

            addReply(reply) {
                this.replies = {
                    ...this.replies,
                    data: [
                        reply,
                        ...this.replies.data
                    ]
                }
            }
        }
    }
</script>