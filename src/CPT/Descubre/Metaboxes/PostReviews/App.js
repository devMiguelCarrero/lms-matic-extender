import { PostInfo, URls } from '../../../../globalComponents/data/pluginData';
import axios from 'axios';
import { __ } from '@wordpress/i18n';
import { useEffect, useState } from '@wordpress/element';

const PostReviewsApp = () => {
  const [reviews, setReviews] = useState(null);

  useEffect(async () => {
    const params = new URLSearchParams();
    params.append('action', 'lmscx_get_post_reviews');
    params.append('current_post', PostInfo.current_post);

    const response = await axios.post(URls.ajax_url, params);
    console.log(response.data);
    setReviews(response.data);
  }, []);

  if (!reviews) {
    return (
      <div className="lmscb-post-reviews">
        {__('Loading...', 'lms-matic-extender')}
      </div>
    );
  }

  return (
    <>
      <div className="lmscb-post-reviews">
        {reviews.length > 0 && (
          <ul className="lmscb-post-reviews__list">
            {reviews.map((review, index) => {
              return (
                <li key={`review-${index}`}>
                  <blockquote>{review}</blockquote>
                </li>
              );
            })}
          </ul>
        )}
        {reviews.length <= 0 && (
          <p className="text-center">
            {__('There are not reviews to show yet', 'lms-matic-extender')}
          </p>
        )}
      </div>
    </>
  );
};
export default PostReviewsApp;
