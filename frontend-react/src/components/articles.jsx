import { useEffect, useState } from "react";
import axios from "axios";

const Articles = () => {
  const [articles, setArticles] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/articles")
      .then((response) => {
        setArticles(response.data.data);
        setLoading(false);
      })
      .catch((error) => {
        console.error("Error fetching articles:", error);
        setError(error.message);
        setLoading(false);
      });
  }, []);

  if (loading)
    return (
      <div className="flex justify-center items-center min-h-[200px]">
        <div className="animate-spin rounded-full h-12 w-12 border-t-4 border-b-4 border-indigo-500"></div>
      </div>
    );

  if (error)
    return (
      <div className="flex justify-center items-center min-h-[200px]">
        <p className="text-red-500">Error loading articles: {error}</p>
      </div>
    );

  return (
    <>
      <main className="py-12 bg-gray-100 min-h-screen">
        <div className="max-w-4xl mx-auto px-6">
          <h1 className="text-3xl font-bold mb-8 text-gray-800">Articles</h1>

          {articles.length === 0 ? (
            <p className="text-gray-500">No articles found.</p>
          ) : (
            <div className="space-y-6">
              {articles.map((article) => (
                <div
                  key={article.article_id}
                  className="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-8"
                >
                  <h2 className="text-2xl font-bold text-indigo-600 mb-2">
                    {article.title}
                  </h2>
                  <p className="text-sm text-gray-500 mb-4">
                    Created on: {new Date(article.create_date).toLocaleDateString()}
                  </p>
                  <div
                    className="text-gray-700 prose max-w-none word-break"
                    dangerouslySetInnerHTML={{ __html: article.body }}
                  />
                </div>
              ))}
            </div>
          )}
        </div>
      </main>
    </>
  );
};

export default Articles;
