import { URls, PostInfo } from '../../../globalComponents/data/pluginData';
import Axios from 'axios';

const accordion = document.querySelector('#lms-comments');

const getStudents = async () => {
  const params = new URLSearchParams();
  params.append('action', 'lmscx_check_course_validation');
  params.append('course', PostInfo.current_post);

  try {
    const response = await Axios.post(URls.ajax_url, params);
    const courseResponse = response.data;

    if (!courseResponse.valid) {
      accordion.style.display = 'none';
    }
  } catch (error) {
    console.log(error);
  }
};

if (accordion) {
  getStudents();
}
