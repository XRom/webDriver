pipeline {
    agent any
    stages {
        stage('Test') {
            steps {
                bat 'php C:\OPEN\OpenServer\domains\robocept\robo.phar parallel:all'
            }
        }
    }
}