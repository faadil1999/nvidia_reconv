from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from app.services import create_chat_completion, get_response_from_completion

app = FastAPI()

class ChatRequest(BaseModel):
    content: str

# Endpoint for sending message
@app.post("/send-message/")
async def send_message(request: ChatRequest):
    try:
        # Initializ the chat generation
        completion = create_chat_completion(request.content)
        return {"status": "success", "completion": completion}
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

# Endpoint for getting the response after sending the message
@app.get("/get-response/")
async def get_response(completion_id: str):
    try:
        # Call function for getting the final response
        completion = create_chat_completion(completion_id)
        response = get_response_from_completion(completion)
        return {"status": "success", "response": response}
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))
