<template>
    <div class="container">
        <div class="card">
          <div class="card-body">
              <div>
                  <div>
                      <p>{{ comment.body }}</p>
                  </div>
                  <div>
                      <p>By: {{ comment.author }}</p>
                  </div>
                  <div>
                      <p>Posted @ {{ comment.posted }}</p>
                  </div>
                  <button v-on:click="showReply" class="pull-right btn btn-info">Reply</button>
                  <hr />
              </div>
              <div>
              <comment-form v-if="showReplyForm" v-on="$listeners" type="reply" :comment="comment"></comment-form>
              <div class="card">
                  <div class="card-header">Replies</div>
                  <div class="card-body">
                    <comment-list v-on="$listeners" :comments="comment.replies"></comment-list>
                  </div>
              </div>
              </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['comment', 'fetchComments'],

        data() {
          return {
            showReplyForm: false
          }
        },

        methods: {
          showReply() {
            this.showReplyForm = true;
          },
        }
    }
</script>
