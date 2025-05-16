from flask import Flask

app = Flask(__name__)

import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
# from keras import Sequential
# from keras.layers import Embedding, Conv1D, MaxPooling1D, LSTM, Dense
# from sklearn.metrics import accuracy_score, confusion_matrix
# from sklearn.model_selection import train_test_split
# from nltk.corpus import stopwords
# import string
# import re
import nltk
from keras.preprocessing.text import Tokenizer
# from keras.utils import pad_sequences


nltk.data.path.append("C:/Users/malki/AppData/Roaming/to/nltk_data")
df = pd.read_csv("C:/Users/malki/Desktop/Data/Datafiniti_Amazon_Consumer_Reviews_of_Amazon_Products.csv")

print(df.shape)
print(df.head(5))

# Setting the Seed for Reproducibility
np.random.seed(0)

# Setting the Hyperparameters
num_words = 10000
oov_token = "<OOV>"
maxlen = 100
embedding_dim = 100
batch_size = 32
epochs = 10

# Create a bar chart of the number of reviews by rating
sns.countplot(x='reviews.rating', data=df)
print(plt.show())

# Create a pie chart of the distribution of reviews by product category
df['categories'].value_counts().head(10).plot.pie()
print(plt.show())

# Create a histogram of the length of the reviews
df['review_length'] = df['reviews.text'].apply(len)
sns.histplot(df['review_length'], bins=50)
print(plt.show())

# Exploratory Data Analysis
# print("Shape of the Data Set:", df.shape)
# print("\nColumns in the Data Set:", df.columns)
# print("\nNumber of Unique Products:", len(df["id"].unique()))

# Cleaning the Data
df.dropna(subset=["reviews.text"], inplace=True)
df = df[["reviews.rating", "reviews.text"]]

# Preparing the Data
X = df["reviews.text"].values
y = df["reviews.rating"].apply(lambda x: 1 if x > 3 else 0).values
tokenizer = Tokenizer(num_words=num_words, oov_token=oov_token)
tokenizer.fit_on_texts(X)
# X = tokenizer.texts_to_sequences(X)
# X = pad_sequences(X, maxlen=maxlen)


# Convert the 'reviews.text' column to lowercase
# df['reviews.text'] = df['reviews.text'].apply(lambda x: x.lower())

# Print the first 5 rows of the 'reviews.text' column
# print(df['reviews.text'].head())

@app.route("/")
def hello_world():
    return "<p>Hello, World!</p>"

