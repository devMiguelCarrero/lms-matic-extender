export default class CourseConstructor {
  // Constructor function to initialize the CourseConstructor object
  constructor(course = null, selectedLesson = null) {
    // If 'course' is not provided, initialize it as an empty array
    this.course = course || [];

    // If 'selectedLesson' is not provided, initialize it to 0
    this.selectedLesson = selectedLesson || 0;
  }

  // Function to set the 'course' property of the CourseConstructor object
  setCourse(course) {
    // If 'course' is provided, update the 'course' property
    if (course) this.course = course;

    // Return the updated object to enable method chaining
    return this;
  }

  // Function to set the 'selectedLesson' property of the CourseConstructor object
  setSelectedLesson(selectedLesson) {
    // If 'selectedLesson' is provided, update the 'selectedLesson' property
    if (selectedLesson) this.selectedLesson = selectedLesson;

    // Return the updated object to enable method chaining
    return this;
  }

  // Function to format the 'course' data
  formatCourse(unformattedCourse) {
    // If 'unformattedCourse' is not an empty array
    this.course =
      unformattedCourse.length > 0
        ? unformattedCourse.map((chapter, index) => {
            // Set 'selected' property of each chapter based on its index
            chapter.selected = index === 0 ? true : false;

            // Initialize 'loaded' and 'selected' properties for each lesson in the chapter
            chapter.lessons = chapter.lessons.map((lesson) => {
              lesson.loaded = false;
              lesson.selected = false;
              lesson.type = 'lesson';
              return lesson;
            });

            // Return the updated chapter
            return chapter;
          })
        : [];

    // Return the updated object to enable method chaining
    return this;
  }

  setEncounters() {
    
  }

  // Function to set the 'selectedLesson' property to the first lesson ID
  setFirstLesson() {
    // If the 'course' is not empty
    this.selectedLesson =
      this.course.length > 0
        ? this.course[0].lessons.length > 0
          ? this.course[0].lessons[0].id
          : 0
        : 0;

    // Return the updated object to enable method chaining
    return this;
  }

  // Function to check if the current lesson is loaded
  isLessonLoaded() {
    // Find the current chapter based on the selected lesson
    const currentChapter = this.course.find((chapter) =>
      chapter.lessons.find((lesson) => lesson.id === this.selectedLesson)
    );

    // Find the current lesson based on the selected lesson
    const currentLesson = currentChapter.lessons.find(
      (lesson) => lesson.id === this.selectedLesson
    );

    // Return whether the current lesson is loaded or not
    return currentLesson.loaded;
  }

  getCurrentChapterIndex() {
    return this.course.findIndex(
      (chapter) =>
        chapter.lessons.findIndex(
          (lesson) => lesson.id === this.selectedLesson
        ) !== -1
    );
  }

  loadLesson(lessonContent) {
    const chapterIndex = this.getCurrentChapterIndex();
    if (chapterIndex !== -1) {
      const LessonIndex = this.course[chapterIndex].lessons.findIndex(
        (lesson) => lesson.id === this.selectedLesson
      );
      this.course[chapterIndex].lessons[LessonIndex].loaded = true;
      this.course[chapterIndex].lessons[LessonIndex].content = lessonContent;
    }
    return this;
  }

  getCurrentLesson() {
    return this.course[this.getCurrentChapterIndex()].lessons.find(
      (lesson) => lesson.id === this.selectedLesson
    );
  }

  // Function to get the 'selectedLesson' property
  getLesson() {
    return this.selectedLesson;
  }

  // Function to get the 'course' property
  get() {
    return this.course;
  }
}
