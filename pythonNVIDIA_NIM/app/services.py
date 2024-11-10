from app.config import client

# Function for sending the message
def create_chat_completion(content):
    completion = client.chat.completions.create(
        model="meta/llama-3.1-405b-instruct",
        messages=[{"role": "user", "content": content}],
        temperature=0.2,
        top_p=0.7,
        max_tokens=1024,
        stream=True
    )
    return completion

# Function for receiving response
def get_response_from_completion(completion):
    response = ""
    for chunk in completion:
        if chunk.choices[0].delta.content is not None:
            response += chunk.choices[0].delta.content
    return response
