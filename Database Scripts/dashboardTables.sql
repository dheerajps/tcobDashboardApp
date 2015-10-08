CREATE TABLE dbo.dashboard_groups (
	group_id VARCHAR(50) PRIMARY KEY
);

CREATE TABLE dbo.dashboard_topics (
	topic_id VARCHAR(50) PRIMARY KEY,
	topic_name VARCHAR(MAX) NOT NULL
);

CREATE TABLE dbo.dashboard_sections (
	section_id VARCHAR(50) PRIMARY KEY,
	section_name VARCHAR(MAX) NOT NULL,
);

CREATE TABLE dbo.dashboard_urls (
	url_id VARCHAR(50) PRIMARY KEY,
	url_name VARCHAR(MAX) NOT NULL,
	topic_id VARCHAR(50),
	section_id VARCHAR(50),
	FOREIGN KEY (topic_id) REFERENCES dbo.dashboard_topics,
	FOREIGN KEY (section_id) REFERENCES dbo.dashboard_sections
);

CREATE TABLE dbo.dashboard_linkURLtoGroup (
	url_id VARCHAR(50),
	group_id VARCHAR(50),
	FOREIGN KEY (url_id) REFERENCES dbo.dashboard_urls,
	FOREIGN KEY (group_id) REFERENCES dbo.dashboard_groups
);
