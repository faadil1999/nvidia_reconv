from dotenv import load_dotenv
import os
from openai import OpenAI

load_dotenv()
# Replace "YOUR_API_KEY" par ta vraie clé API NVIDIA
API_KEY = os.getenv("NVIDIA_API_KEY")

# Initialize the client OpenAI
client = OpenAI(
    base_url="https://integrate.api.nvidia.com/v1",
    api_key=API_KEY
)
