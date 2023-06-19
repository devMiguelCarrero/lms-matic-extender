import { useEffect, useState } from '@wordpress/element';
import LogoLoader from '../../../../globalComponents/LogoLoader/LogoLoader';
import Axios from 'axios';

import {
  textDomain,
  URls,
  PostInfo,
} from '../../../../globalComponents/data/pluginData';

const FrontApp = () => {
  const [course, setCourse] = useState([]);

  useEffect(async () => {
    const params = new URLSearchParams();
    params.append('action', 'lmscx_check_course_validation');
    params.append('course', PostInfo.current_post);

    try {
      const response = await Axios.post(URls.ajax_url, params);
      console.log(response.data);
    } catch (error) {
      console.log(error);
    }
  }, []);

  console.log(course);

  return (
    <div class="lms-section border-section">
      <div class="compressed-container">
        <LogoLoader />
      </div>
    </div>
  );
};
export default FrontApp;
