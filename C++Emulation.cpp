#include<bits/stdc++.h>
using namespace std;

int views(vector <vector<float> >w, float t) {
	vector<float> video;
	vector<int>count;
	int c = 0;
	float ans;
	while(1) {
		bool t = true;
		cin>>t;
		if(t) {
			cout<<"What's ur preference? No.?"<<endl;
			int stances;
			cin>>stances;
			for(int i=0;i<stances;i++) {
				cin>>ans;
				video.push_back(ans);
			}
			for(int j=0;j<video.size()-1;j++) {
				c=0;
				for(int i=0;i<w.size();i++) {
					if(w[i][0] > video[i] && w[i][0] < video[i+1]) {
						c++;			
					}
				}
				count.push_back(c);
			}
			for(int i=0;i<count.size()-1;i++) {
				cout<<video[i]<<" "<<video[i+1]<<" "<<count[i]<<endl;
			}
		}
		else {
			cout<<"You are breaking from the statistics program"<<endl;
			exit(0);
		}	
	}
}

int main() {
	vector< vector<float> >watchTime;
	//If a person is watching YouTube's video multiple times, consider the max time for that viewer.
	//indices represent the viewers, array -> view times.
	float totalTime,n; //n is the number of viewers, totalTimeis total duration of video.
	cin>>totalTime;
	cin>>n;
	for(int i=0;i<n;i++) {
		watchTime.push_back(vector<float> () );
		srand(time(0));
		watchTime[i].push_back(rand() % int(ceil(totalTime))+0);
	}
	views(watchTime,totalTime);
}
