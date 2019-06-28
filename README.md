## Discussion GraphQL API in Symfony 4

This is a discussion api  using [GraphQLBundle](https://github.com/Youshido/GraphQLBundle) in Symfony 4 , 
.

### How to Run


Clone the app :

    git clone https://github.com/thecomputermanonline/discussionapi.git

 Install dependencies:

    composer install

Add Database credentials in .env file and make the migration

     bin/console make:migration

Run the migration

     bin/console doctrine:migrations:migrate
     
load the the Fixtures to have some sample datta

     bin/console doctrine:fixtures:load
   

Run the web server

     bin/console server:run
     

### Example Query
Go to `127.0.0.1/graphql/explorer` to run examples or if you prefer append the request to `127.0.0.1/graphql?query=` 
``

Request:

   
      {
          userFields {
            id
          }
      }


Response:

    
       {
      {
        "data": {
          "userFields": [
            {
              "id": "1"
            },
            {
              "id": "2"
            },
            {
              "id": "3"
            }
          ]
        }
      }
    


Request:

   
      user(id:"1") {
           id
           countUnreadMessages
           messages {
             id
           }
         }


Response:

    
       {
         "data": {
           "user": {
             "id": "1",
             "countUnreadMessages": 2,
             "messages": [
               {
                 "id": "1"
               },
               {
                 "id": "2"
               },
               {
                 "id": "3"
               }
             ]
           }
         }
       }
    

Request:

   
       user(id:"1") {
         firstName
         countUnreadMessages
         messages {
           id
         }
         threads {
           id
           participants {
             id
           }
           messages {
             id
           }
         }
       }

Response:

    
       {
         "data": {
           "user": {
             "firstName": "Roger",
             "countUnreadMessages": 2,
             "messages": [
               {
                 "id": "1"
               },
               {
                 "id": "2"
               },
               {
                 "id": "3"
               }
             ],
             "threads": [
               {
                 "id": "1",
                 "participants": [
                   {
                     "id": "1"
                   }
                 ],
                 "messages": []
               },
               {
                 "id": "2",
                 "participants": [
                   {
                     "id": "1"
                   }
                 ],
                 "messages": []
               },
               {
                 "id": "3",
                 "participants": [
                   {
                     "id": "1"
                   }
                 ],
                 "messages": []
               },
               {
                 "id": "4",
                 "participants": [
                   {
                     "id": "1"
                   }
                 ],
                 "messages": []
               },
               {
                 "id": "5",
                 "participants": [
                   {
                     "id": "1"
                   }
                 ],
                 "messages": [
                   {
                     "id": "1"
                   },
                   {
                     "id": "2"
                   },
                   {
                     "id": "3"
                   }
                 ]
               }
             ]
           }
         }
       
    }

### Example Mutation


Request:

   
    mutation{
      addMetadata(metadata:{readDate:"1/1/2019",message:"3", user:"1"}) {
        id
      }
    }
    
    

Response:

    {
       "data": {
           "addMetadata": {
             "id": "3"
           }
         }
    }

Request:

    {
    
    mutation{
      postMessage(message:{date:"1/1/2019",content:"message32",user:"61",thread:"16"}) {
        id
      }
    }
    
    }

Response:

    {
        "data": {
           "postMessage": {
             "id": "4"
           }
         }
    }
    
    NB:IDS might be different depending on your datbase increment