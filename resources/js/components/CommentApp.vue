<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <comment-form type="comment" @fetchComments="fetchComments"></comment-form>
                <comment-list :comments="comments" @fetchComments="fetchComments"></comment-list>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchComments();
        },

        data() {
            return {
              comments: []
            }
        },

        methods: {
            fetchComments() {
              axios.get('/comments')
                .then((response) => {
                  this.comments = response.data.data;
                });
            },

            replyTo(commentId) {
              this.comment.parent_id = commentId;
            },

            clearErrorValidationMessage() {
              this.error = {
                'message': '',
                'errors': {}
              };
            }
        }
    }
</script>
