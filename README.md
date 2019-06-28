## Discussion GraphQL API in Symfony 4

This is a discussion api  using [GraphQLBundle](https://github.com/Youshido/GraphQLBundle) in Symfony 4 , 
.

### How to Run

Install dependencies:

    composer install

Add Databse credentials in .env file and Run the web server:

    bin/console server:run


### Example Query
Go to `127.0.0.1/graphql/explorer` to run examples or if you prefer append the request to `127.0.0.1/graphql?query=` 
``


Request:

   
      user(id:"61") {
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
             "id": "61",
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

   
       user(id:"61") {
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
                 "id": "16",
                 "participants": [
                   {
                     "id": "61"
                   }
                 ],
                 "messages": []
               },
               {
                 "id": "17",
                 "participants": [
                   {
                     "id": "61"
                   }
                 ],
                 "messages": []
               },
               {
                 "id": "18",
                 "participants": [
                   {
                     "id": "61"
                   }
                 ],
                 "messages": []
               },
               {
                 "id": "19",
                 "participants": [
                   {
                     "id": "61"
                   }
                 ],
                 "messages": []
               },
               {
                 "id": "20",
                 "participants": [
                   {
                     "id": "61"
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
      addMetadata(metadata:{readDate:"1/1/2019",message:"3", user:"61"}) {
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